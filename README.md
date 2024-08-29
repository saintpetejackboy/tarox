# Tarox: Tarot Card Reading Application

## Overview

Tarox offers an immersive tarot reading experience, blending client-side and server-side technologies. Originally designed as a serverless web application, Tarox now leverages PHP alongside HTML, CSS, and JavaScript (with jQuery, GSAP, and Tailwind loaded via CDN) to deliver mystical insights and a highly customizable experience.

## Key Features

- **Dynamic Card Selection**: Engage with pulsating cards that smoothly transition into place upon selection.
- **Deck Customization**: Select different deck graphics for a personalized reading experience.
- **Deck Scraping**: Easily scrape new decks from [CardScans](https://cardscans.piwigo.com/) for use in your readings.
- **Card and Folder Renaming**: Rename scraped deck cards and folders for better organization.
- **Deck Finalization**: Convert finalized decks to `.webp` format for optimized performance.
- **Customizable Card Backs**: Customize card back images for a personalized touch during loading.
- **Enhanced Mobile Experience**: Improved font scaling and better element binding with increased padding for mobile devices.
- **Comprehensive Interpretations**: Dive deep into each card's symbolism and significance within your reading.
- **Combination Analysis**: Uncover nuanced meanings through the interplay of selected cards.
- **Celestial Ambiance**: Immerse yourself in a mesmerizing starfield backdrop, complete with optional hyperspace effects and ephemeral shooting stars.
- **Updated Documentation**: Includes up-to-date help and README files for easy setup and use.

## User Journey

1. Start your session with the "Begin" button, prompting a shuffle of the deck.
2. Choose from an array of 10 pulsating cards, each revealing its secrets upon selection.
3. Explore combination interpretations after your initial selection for a more profound reading.

## Technical Architecture

- `index.php`: Application entry point, utilizing PHP for backend processes.
- `css/styles.css`: Visual styling definitions.
- `js/stars.js`: Celestial animation logic.
- `js/cardInfo.js`: Tarot card data repository.
- `js/main.js`: Core application functionality.
- `img/`: Repository for visual assets, including deck graphics and card backs.

## Deployment

Tarox now requires a server capable of running PHP. You can still deploy it on static hosting platforms with PHP support.

### Local Setup

```bash
git clone https://github.com/saintpetejackboy/tarox.git
cd tarox
# Serve the application with a local PHP server
php -S localhost:8000
# Open your browser and navigate to http://localhost:8000
```

### GitHub Pages Deployment (For Client-Side Only)

1. Push your repository to GitHub.
2. Navigate to repository settings.
3. Under "Pages," configure for the main branch deployment.
4. Note: PHP functionality will not be available on GitHub Pages.

## Contribute

We welcome enhancements and bug fixes. Feel free to open issues or submit pull requests to contribute to Tarox's evolution.

## License

Tarox is distributed as open-source freeware, with no formal license. Enjoy and modify as you see fit.

