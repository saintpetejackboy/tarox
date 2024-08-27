<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarox</title>
    <?php include('scripts.php'); ?>
    <?php include('css.php'); ?>
</head>

<body class="min-h-screen flex flex-col items-center justify-center p-4">
<div class="stars"></div>

<div class="modal">
<p style="color: cyan;">Deafchild Tarot</p>
<p>Select cards as they pulsate.</p>
<p>View position info (lower right) and card details (upper left).</p>
<p>After selection, choose 'Combinations' (upper right).</p>
<p>Select 'Begin' to start.</p>
    
    <button id="start-reading"
        class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-1 px-2 text-sm rounded-full shadow-lg transition duration-300 ease-in-out transform hover:scale-105 mt-4">
        Begin
    </button>
    </p>
</div>

<button id="combinations-button"
    class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-1 px-2 text-sm rounded-full shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
    Combinations
</button>

<div id="reading-area" class="mt-8"></div>
<div id="selected-card" class="fade-in"></div>
<div id="position-info" class="fade-in"></div>

    <script>
$(document).ready(function () {
    <?php include('stars.js'); ?>
    <?php include('cardInfo.js'); ?>

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
                if ($(this).hasClass('pulse')) {
                    showCardDetails(card, index);
                    $(this).removeClass('pulse').addClass('clicked');
                    currentCardIndex++;
                    if (currentCardIndex < selectedCards.length) {
                        $(`.card[data-index="${currentCardIndex}"]`).addClass('pulse');
                    }
                    if (currentCardIndex === 1) {
                        $('#combinations-button').show();
                    }
                }
            });
    }

    function animateCardPlacement(cardElement, index, callback) {
        gsap.to(cardElement, {
            opacity: 1,
            rotation: 0,
            scale: 1,
            duration: 1.5,
            delay: index * 0.3,
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

        imgElement.on('load', function() {
            $('#selected-card').html(`
                <h3><span class="cardTitle">${cardName}</span></h3>
                ${imgElement.prop('outerHTML')}
                <h4>${cardDefinitions[card]}</h4>
            `).removeClass('show').addClass('fade-in').show();

            setTimeout(() => {
                $('#selected-card').addClass('show');
            }, 50);
        });

        $('#position-info').html(`
            <h3>Position ${index + 1}: ${position.name}</h3>
            <p>${position.description}</p>
        `).removeClass('show').addClass('fade-in').show();

        setTimeout(() => {
            $('#position-info').addClass('show');
        }, 50);
    }

    function startReading() {
        $('.modal').fadeOut();
        $('#reading-area').empty();
        $('#selected-card, #position-info').hide().removeClass('show');
        selectedCards = selectUniqueCards(10);
        let animationsCompleted = 0;

        selectedCards.forEach((card, index) => {
            const cardElement = createCardElement(card, index);
            $('#reading-area').append(cardElement);

            animateCardPlacement(cardElement, index, () => {
                animationsCompleted++;
                if (animationsCompleted === selectedCards.length) {
                    $(`.card[data-index="0"]`).addClass('pulse');
                }
            });
        });

        $('#start-reading').hide();
        $('.card').addClass('floating');
    }

    function getCombinationText(value, count) {
        const combinations = {
            king: ['Two Kings: Business partnership. Good advice.', 'Three Kings: Good support.', 'Four Kings: Rewards, success.'],
            queen: ['Two Queens: Meeting with a friend. Idle chatter, gossip or curiosity.', 'Three Queens: Visits, or a betrayal of confidence.', 'Four Queens: Social events. May also represent scandals.'],
            jack: ['Two Jacks: Disagreements.', 'Three Jacks: False friends, or quarrels.', 'Four Jacks: High spirits. May also represent parties, or battles.'],
            10: ['Two Tens: Circumstances improve. Two red tens may signal a wedding.', 'Three Tens: Plans get upset.', 'Four Tens: Guaranteed success.'],
            9: ['Two Nines: Minor gains.', 'Three Nines: Good health.', 'Four Nines: Wishes come true.'],
            8: ['Two Eights: Indiscretion. A brief affair causes regret. Two red eights signals new clothes.', 'Three Eights: Not good to make long term commitments now.', 'Four Eights: Worries and burdens prove too much to handle.'],
            7: ['Two Sevens: Light-hearted fun. Two red sevens represent love and pleasure.', 'Three Sevens: Lowered vitality, or a brief illness.', 'Four Sevens: Conspiracy.'],
            6: ['Two Sixes: Contradictions.', 'Three Sixes: Hard work.', 'Four Sixes: Unexpected challenges.'],
            5: ['Two Fives: Personal challenges.', 'Three Fives: Disappointments.', 'Four Fives: Personal desires realized.'],
            4: ['Two Fours: Shaky foundation.', 'Three Fours: Foundation weakened.', 'Four Fours: Secure foundation.'],
            3: ['Two Threes: Choices.', 'Three Threes: Stability.', 'Four Threes: Hope.'],
            2: ['Two Twos: Parting of ways.', 'Three Twos: Direction reversed.', 'Four Twos: Reaching a crossroads.'],
            ace: ['Two Aces: Partnerships or reunions. Clubs and Hearts are marriage, while Spades and Diamonds represent a difficult union.', 'Three Aces: Good news, a lucky break.', 'Four Aces: Triumph.']
        };

        // Convert numbered values to strings if they're numbers
        const key = typeof value === 'number' ? value.toString() : value.toLowerCase();

        if (combinations[key] && combinations[key][count - 2]) {
            return combinations[key][count - 2];
        } else {
            console.warn(`No combination text found for ${value} with count ${count}`);
            return `${count} ${value}s: No specific meaning defined.`;
        }
    }

    function combinations() {
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

        if (combinationTexts.length === 0) {
            $('#selected-card').html('<h3>Your Combinations</h3><p>No combinations found in this reading.</p>');
        } else {
            let combinationHtml = '<h3 style="color: cyan; font-size: .9rem; font-weight: bold;">Your Combinations</h3>';
            combinationTexts.forEach(combo => {
                combinationHtml += '<div class="combination">';
                combo.cards.forEach(card => {
                    combinationHtml += `<img src="img/${card}.png" alt="${card}" style="width: 40px; height: auto; margin-right: 5px;">`;
                    $(`.card[style*="img/${card}.png"]`).addClass('pulse');
                });
                combinationHtml += `<p style="font-size: 0.7rem; margin-top: 5px; color: white;">${combo.text}</p></div>`;
            });
            $('#selected-card').html(combinationHtml);
        }
    }

    $('#start-reading').on('click', startReading);
    $('#combinations-button').on('click', combinations);
});
    </script>
</body>
</html>