let currentCardIndex = 0;
let selectedCards = [];

function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

function selectUniqueCards(count) {
    shuffleArray(cards);
    const selectedCardsSet = new Set();
    while (selectedCardsSet.size < count) {
        const randomIndex = Math.floor(Math.random() * cards.length);
        selectedCardsSet.add(cards[randomIndex]);
    }
    return Array.from(selectedCardsSet);
}

function createCardElement(card, index) {
    return $('<div>')
        .addClass('card')
        .attr('data-index', index)
        .css({
            backgroundImage: `url('img/${card}.png')`,
            backgroundSize: 'cover',
            left: cardPositions[index].left,
            top: cardPositions[index].top,
            transform: 'translate(-50%, -50%) rotate(720deg) scale(0.1)',
            opacity: 0
        })
        .on('click', function () {
            showCardDetails(card, index);
            $(this).addClass('clicked');
            currentCardIndex = index + 1; // Set currentCardIndex to the next card
            if (currentCardIndex < selectedCards.length) {
                $(`.card[data-index="${currentCardIndex}"]`).addClass('pulse');
            }
            if (currentCardIndex === 1) {
                $('#combinations-button').show();
            }
            
        });
}

function animateCardPlacement(cardElement, index, callback) {
    const delay = index === 10 ? 0 : index * 0.3;

    gsap.to(cardElement, {
        opacity: 1,
        rotation: 0,
        scale: 1,
        duration: 1.5,
        delay: delay,
        ease: 'power2.out',
        onComplete: callback
    });
}


function showCardDetails(card, index) {
const cardName = card.replace(/_/g, ' ').replace(/\.\w+$/, '');
const position = positions[index];

const imgElement = $('<img>', {
src: `img/${card}.png`,
style: 'width: 80%; max-width: 80px; height: auto; margin: 20px auto; display: block;'
});

$('#selected-card').addClass('fade-in').html(`
<h3><span class="cardTitle">${cardName}</span></h3>
${imgElement.prop('outerHTML')}
<h4>${cardDefinitions[card]}</h4>
`);

imgElement.on('load', function() {
// Add the 'show' class after the image has loaded to avoid flicker
$('#selected-card').addClass('show');
$('#selected-card').fadeIn(500);

        $('.card').removeClass('pulse'); // Remove pulse from all cards
        if (currentCardIndex <= selectedCards.length) {
            $(`.card[data-index="${currentCardIndex}"]`).addClass('pulse');
        }

        if (currentCardIndex == 10) {

            $(`#combinations-button`).addClass('lookAtMe');
        }

        // Progress the sequence when the modal image is clicked
        $('#selected-card img').on('click', function() {
            if (currentCardIndex < selectedCards.length) {
                $(`.card[data-index="${currentCardIndex}"]`).trigger('click'); // Trigger click event on the next card
            }
            console.log(currentCardIndex+' of '+selectedCards.length);
            if (currentCardIndex == selectedCards.length) {
            
               $('#combinations-button').click();

            } 
        });
    });


    $('#position-info').html(`
        <h3 style='color: #CBC3E3; font-weight: bold;'> ${index + 1}: ${position.name}</h3>
        <p>${position.description}</p>
    `).removeClass('show').addClass('fade-in').show();

    setTimeout(() => {
        $('#position-info').addClass('show');
    }, 50);
}

const overlay = $('<div class="loading-overlay"></div>');
overlay.css({
position: 'fixed',
top: 0,
left: 0,
width: '100vw',
height: '100vh',
backgroundColor: 'rgba(0, 0, 0, 0.3)', // Adjust transparency as needed
zIndex: 1000, // Make sure it's on top of other elements
});

function startReading() {

    $('body').append(overlay);
    $('.modal').fadeOut();
    $('#reading-area').empty();
    $('#selected-card, #position-info').hide().removeClass('show');
    selectedCards = selectUniqueCards(10);
    let animationsCompleted = 0;
    hyperSpaceStart();
    selectedCards.forEach((card, index) => {
        const cardElement = createCardElement(card, index);
        $('#reading-area').append(cardElement);

        animateCardPlacement(cardElement, index, () => {
            animationsCompleted++;
            if (animationsCompleted === selectedCards.length) {
                $(`.card[data-index="0"]`).addClass('pulse');
                $('.loading-overlay').remove(); // Remove the overlay after animations
                hyperSpaceStop();
                }
        });
    });

    $('#start-reading').hide();
    $('.card').addClass('floating');
}


function combinations() {
    $('#position-info').addClass('show');
    $('#selected-card').addClass('show');
    $('#position-info').fadeIn(200);
    $('#position-info').html('<p>Your combinations can influence your reading, pay attention to their positions.</p>');
    const counts = {};
    const combinationCards = {};
    const combinationTexts = [];

    selectedCards.forEach(card => {
        const [value] = card.split('_of_');
        counts[value] = (counts[value] || 0) + 1;
        combinationCards[value] = combinationCards[value] || [];
        combinationCards[value].push(card);
    });

    Object.entries(counts).forEach(([value, count]) => {
        if (count >= 2) {
            const text = getCombinationText(value, count);
            if (text) {
                combinationTexts.push({ cards: combinationCards[value], text });
            }
        }
    });

                // Clear all existing pulse classes before adding new ones
        $('.card').removeClass('pulse');
    if (combinationTexts.length === 0) {
        $('#selected-card').html('<h3>Your Combinations</h3><p>No combinations found in this reading.</p>');
    } else {
        let combinationHtml = '<h3 style="color: cyan; font-size: .9rem; font-weight: bold;">Your Combinations</h3>';
        combinationTexts.forEach(combo => {
            combinationHtml += '<div class="combination">';
            combo.cards.forEach(card => {
                $(`.card[style*="img/${card}.png"]`).addClass('pulse');
                combinationHtml += `<img src="img/${card}.png" alt="${card}" style="width: 40px; height: auto; margin-right: 5px;">`;
                $(`.card[style*="img/${card}.png"]`).addClass('pulse');
            });
            combinationHtml += `<p style="font-size: 0.7rem; margin-top: 5px; color: white;">${combo.text}</p></div>`;
        });
        $('#selected-card').html(combinationHtml);
    }
   
}

$(document).on('click', '.combinations-button', function(){
    combinations();
    $('.combinations-button').removeClass('lookAtMe');

    });



function hideDetails() {
    $('#selected-card, #position-info').removeClass('show');
}

$(document).on('click', function (e) {
    if (!$(e.target).closest('.card, #selected-card, #position-info, .combinations-button, img').length) {
        hideDetails();
    }
});

$('#start-reading').on('click', startReading);