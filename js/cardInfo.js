const cardDefinitions ={
    '2_of_clubs' : 'Bad luck. Being let down by those around. Opposition from friends and family. Do not count on others.',
    '3_of_clubs' : 'A danger card, showing misfortune or failure. Supposed friends getting in the way, or turning against you.',
    '4_of_clubs' : 'A marriage card, or the beginning of a long standing alliance.',
    '5_of_clubs' : 'A partnership card. Success based on mutual goals and friendship.',
    '6_of_clubs' : 'A card of good luck, if other favorable cards are around. Success if there is no interference from the opposite sex.',
    '7_of_clubs' : 'A sense of desperation. An urgent need for money.',
    '8_of_clubs' : 'Trouble: Represents arguments with good friends. A loss of a relationship, a dispute that will remain unresolved.',
    '9_of_clubs' : 'A card of happiness and good fortune. Can also represent a long and fun-filled journey.',
    '10_of_clubs' : 'Represents a good friend, one who uses a lot of flattery, but only to make the other person feel better. Someone who is good at cheering you up.',
    'jack_of_clubs' : 'Represents a good friend, one who uses a lot of flattery, but only to make the other person feel better. Someone who is good at cheering you up.',
    'queen_of_clubs' : 'Represents a wife or girlfriend in a long-term relationship for a man. For a woman, represents a sister or good friend, someone who shares a lot of knowledge about you.',
    'king_of_clubs' : 'Represents a very good friend. A lifelong companion, someone who can be trusted and counted on during times of need and sorrow.',
    'ace_of_clubs' : 'Indicates wealth, fame...having many friends or acquaintances. Feeling well known and being able to receive certain perks due to good looks or social status.',
    '2_of_hearts' : 'Success, often beyond your expectations. If bad cards surround, there may be delays in reaching the goal.',
    '3_of_hearts' : 'An unwise decision, made in haste and without proper background information.',
    '4_of_hearts' : 'The bachelor or old maid card. This card represents someone who is too fussy in their selection of a partner. Someone who, by their picky nature, is destined to remain alone. Could represent you in some situations.',
    '5_of_hearts' : 'Indecisiveness: Your inability to make up your mind on a subject. A tendency to make and break plans with others.',
    '6_of_hearts' : 'Warning card. Someone may try to take advantage of you. Also, you are being too generous to somebody and not getting anything in return. You are being used.',
    '7_of_hearts' : 'A card of disappointment. Usually indicates a partner or other person failing to keep their promises. If this card comes up when dealing with some sort of plan, expect that the other person will back out.',
    '8_of_hearts' : 'An event, a celebration, a holiday, a party/bash... etc. Some sort of ceremony that is in the works or is being planned.',
    '9_of_hearts' : 'Harmony. Often called the Wish Card. If surrounded by bad cards, these can represent obstacles that need to be dealt with in order to get the fulfillment of the wish.',
    '10_of_hearts' : 'A good card: means good luck, can counteract bad cards around it.',
    'jack_of_hearts' : 'A good friend to the querent, someone close, a cousin or confidant, someone they have known since childhood or for a long time.',
    'queen_of_hearts' : 'A trusted woman. Someone knowledgeable and faithful. One who always plays fair.',
    'king_of_hearts' : 'Represents an influential man, someone who has the power or ability to do something good for you.',
    'ace_of_hearts' : 'Has to do with your home or environment. Could represent a visit or a change of address.',
    '2_of_spades' : 'A complete and forced change. Sudden change of location, relationship or a death. Bound to make a big difference in the coming months.',
    '3_of_spades' : 'Unhappiness: Misfortune in love or marriage. A loss of pride and hope. Do not dwell, move on in life.',
    '4_of_spades' : 'Minor misfortune: A short illness, a temporary setback.',
    '5_of_spades' : 'Success in business or love, after much time and hard work.',
    '6_of_spades' : 'Much planning but little result. Hard work, without much profit. Discouragements.',
    '7_of_spades' : 'Sorrow and quarrels. Avoid arguments with friends. Let them "win" for now.',
    '8_of_spades' : 'False friends, traitors, someone who will betray. Most of the trouble can be avoided if caught early on. Examine all relationships closely.',
    '9_of_spades' : 'The worst card of all: Illness, loss of money, or misery. Even among the best of cards. Defeat, lack of success.',
    '10_of_spades' : 'A very unlucky card. If near a good card, it can cancel it out. If found with bad cards, makes them twice as bad.',
    'jack_of_spades' : 'A person who hangs around and gets in the way. Not a bad person, but a lazy person. One who will get in the way of progress. Takes and takes, but does not give back anything.',
    'queen_of_spades' : 'A cruel person, one who interferes. For women, a betrayal by a good friend. For men, a person who will use them for their own gain.',
    'king_of_spades' : 'A person who will cause problems in marriage or relationships. One who will get in the middle, divide and conquer... and then destroy.',
    'ace_of_spades' : 'Bad news, loss of someone close, possible death to someone near, or an illness, miscarriage, etc.; Physical pain.',
    '2_of_diamonds' : 'A serious love affair, resulting in a marriage or interfering with one depending on surrounding cards. Can also represent one venture or project interfering with another.',
    '3_of_diamonds' : 'A card of disputes and quarrels. Lawsuits, legal actions. A sign of separation or divorce.',
    '4_of_diamonds' : 'Quarrels: Forgotten or neglected friends and family. Situations that have been brewing and now come to a head.',
    '5_of_diamonds' : 'Prosperity, long enduring friendship. Pride in family. Success with children.',
    '6_of_diamonds' : 'An early marriage, partnership or venture, but an unhappy one... and one not destined to last. A second attempt would also be unhappy.',
    '7_of_diamonds' : 'Bad luck on an enterprise or idea. A man who is unreliable, a gambler, drinker or drug addict.',
    '8_of_diamonds' : 'Country life, travel and marriage late in life. Your life is too hectic at the moment... there is a need to settle down and get away... but you are unable to do so at the present time.',
    '9_of_diamonds' : 'Adventure: A move in the hopes of advancement.',
    '10_of_diamonds' : 'Money. Money being the driving force of a journey or partnership. Greed.',
    'jack_of_diamonds' : 'A bringer of bad news. A selfish person. Not dangerous to male querents, but problems for a female one.',
    'queen_of_diamonds' : 'A flirtatious person, one who will interfere in plans. Gossipy, very attractive to males... able to get away with things and interfere in situations.',
    'king_of_diamonds' : 'A bitter rival, a dangerous competitor, for women it can mean an abusive man or a deceitful lover.',
    'ace_of_diamonds' : 'An important message. A letter or package/gift arriving, the contents of which are very important.'
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
    
    const cards = [
        '2_of_clubs', '2_of_diamonds', '2_of_hearts', '2_of_spades',
        '3_of_clubs', '3_of_diamonds', '3_of_hearts', '3_of_spades',
        '4_of_clubs', '4_of_diamonds', '4_of_hearts', '4_of_spades',
        '5_of_clubs', '5_of_diamonds', '5_of_hearts', '5_of_spades',
        '6_of_clubs', '6_of_diamonds', '6_of_hearts', '6_of_spades',
        '7_of_clubs', '7_of_diamonds', '7_of_hearts', '7_of_spades',
        '8_of_clubs', '8_of_diamonds', '8_of_hearts', '8_of_spades',
        '9_of_clubs', '9_of_diamonds', '9_of_hearts', '9_of_spades',
        '10_of_clubs', '10_of_diamonds', '10_of_hearts', '10_of_spades',
        'jack_of_clubs', 'jack_of_diamonds', 'jack_of_hearts', 'jack_of_spades',
        'queen_of_clubs', 'queen_of_diamonds', 'queen_of_hearts', 'queen_of_spades',
        'king_of_clubs', 'king_of_diamonds', 'king_of_hearts', 'king_of_spades',
        'ace_of_clubs', 'ace_of_diamonds', 'ace_of_hearts', 'ace_of_spades'
    ];

    const positions = [
        { name: 'Heart of the Matter', description: 'This card is what your reading will discuss today.' },
        { name: 'Root Cause', description: 'A very long time ago, somehow related...' },
        { name: 'Crossing You', description: 'May be helping you or hurting you.' },
        { name: 'Recent Event', description: 'You should be able to remember this, recently...' },
        { name: 'Possible Outcome', description: 'An unlikely, but possible outcome, is that...' },
        { name: 'Near Future', description: 'This WILL happen, very soon.' },
        { name: 'You', description: 'This is what YOU are bringing to the equation.' },
        { name: 'Environment', description: 'Is your environment helping you or hurting you?' },
        { name: 'Hopes/Fears', description: 'What do you hope? What do you fear?' },
        { name: 'Outcome', description: 'What happens at the end? Most likely result.' }
    ];

    const cardPositions = [
            { left: '45%', top: '45%' },   // 1 (center, moved up and left)
            { left: '45%', top: '25%' },   // 2
            { left: '65%', top: '45%' },   // 3
            { left: '45%', top: '65%' },   // 4
            { left: '25%', top: '45%' },   // 5
            { left: '45%', top: '5%' },    // 6
            { left: '85%', top: '45%' },   // 7
            { left: '45%', top: '85%' },   // 8
            { left: '5%', top: '45%' },    // 9
            { left: '80%', top: '10%' }    // 10 (upper right corner)
        ];