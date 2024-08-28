# Tarox: Serverless Tarot Card Reading

## Overview

Tarox offers an immersive, client-side tarot reading experience. This serverless web application leverages HTML, CSS, and JavaScript (with jquery, gsap and tailwind loaded via CDN) to deliver mystical insights without backend dependencies.

## Key Features

- **Dynamic Card Selection**: Engage with pulsating cards that smoothly transition into place upon selection.
- **Comprehensive Interpretations**: Dive deep into each card's symbolism and significance within your reading.
- **Combination Analysis**: Uncover nuanced meanings through the interplay of selected cards.
- **Celestial Ambiance**: Immerse yourself in a mesmerizing starfield backdrop, complete with optional hyperspace effects and ephemeral shooting stars.

## User Journey

1. Initiate your session with the "Begin" button, prompting a shuffle of the deck.
2. Select from an array of 10 pulsating cards, each revealing its secrets upon choice.
3. Delve into combination interpretations after your initial selection for a more profound reading.

## Technical Architecture

- `index.html`: Application entry point
- `css/styles.css`: Visual styling definitions
- `js/stars.js`: Celestial animation logic
- `js/cardInfo.js`: Tarot card data repository
- `js/main.js`: Core application functionality
- `img/`: Optional repository for visual assets

## Deployment

Tarox's serverless nature allows for effortless deployment across various static hosting platforms.

### Local Setup

```bash
git clone https://github.com/saintpetejackboy/tarox.git
cd tarox
# Open index.html in your preferred browser
```

### GitHub Pages Deployment

1. Push your repository to GitHub.
2. Navigate to repository settings.
3. Under "Pages", configure for main branch deployment.
4. Access your live application at `https://saintpetejackboy.github.io/tarox/`.

## Contribute

We welcome enhancements and bug fixes. Feel free to open issues or submit pull requests to contribute to Tarox's evolution.

## License

Tarox is distributed under no license and is entirely open source freeware.