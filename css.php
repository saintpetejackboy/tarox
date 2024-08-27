<style>
        body {
            background-color: #111827;
            color: #e5e7eb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
        }

        .card {
            position: absolute;
            border-radius: 7px;
            box-shadow: 0 0 15px rgba(66, 153, 225, 0.5);
            transition: transform 0.3s ease, box-shadow 0.3s ease, filter 0.3s ease;
            backface-visibility: hidden;
            cursor: pointer;
        }

        .card:hover {
            transform: scale(1.1);
            box-shadow: 0 0 20px rgba(66, 153, 225, 0.7);
        }

        .card.clicked {
            border: 3px solid black;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
            filter: grayscale(100%);
        }

        .card.pulse {
            animation: pulse 1s infinite, rainbow 2s infinite, brightness 3s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
            }
            70% {
                box-shadow: 0 0 0 20px rgba(255, 255, 255, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
            }
        }
        @keyframes rainbow {
    0%, 100% { box-shadow: 0 0 20px rgba(255, 0, 0, 0.7); }
    14% { box-shadow: 0 0 30px rgba(255, 127, 0, 0.7); }
    28% { box-shadow: 0 0 40px rgba(255, 255, 0, 0.7); }
    42% { box-shadow: 0 0 60px rgba(0, 255, 0, 0.7); }
    57% { box-shadow: 0 0 50px rgba(0, 127, 255, 0.7); }
    71% { box-shadow: 0 0 40px rgba(75, 0, 130, 0.7); }
    85% { box-shadow: 0 0 30px rgba(143, 0, 255, 0.7); }
}
        @keyframes brightness {
            0% { filter: brightness(100%); }
            50% { filter: brightness(150%); }
            100% { filter: brightness(100%); }
        }

        #reading-area {
            position: relative;
            width: 100%;
            height: 90vh;
            max-width: 500px;
            margin: 0 auto;
        }

        .stars {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-7px); }
            100% { transform: translateY(0px); }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        #selected-card {
            position: fixed;
            top: 10px;
            left: 10px;
            padding: 5px 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            border-radius: 5px;
            font-size: 1.2em;
            display: none;
            max-width: 40%;
            font-size: .8rem;
        }

        @media (max-width: 600px) {
            .card {
                width: 40px;
                height: 60px;
            }
        }

        @media (min-width: 601px) {
            .card {
                width: 70px;
                height: 105px;
            }
        }
        .cardTitle {
            text-transform: capitalize;
            font-size: 1rem;
            color: cyan;
            font-weight: bold;
            text-align: center;
            width: 100%;
            margin: auto;
        }
        #combinations-button {
            position: absolute;
            top: 1rem;
            right: 1rem;
            display: none;
        }
        .fade-in {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
        .fade-in.show {
            opacity: 1;
        }
        #selected-card, #position-info {
            background: rgba(20,20,20,0.7);
            padding: 20px;
            border: 1px solid black;
            color: white;
            margin-top: 20px;
            max-width: 300px;
        }
        #selected-card {
            position: fixed;
            top: 20px;
            left: 20px;
        }
        #position-info {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }
        .combination {
    margin-bottom: 15px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
    color: white;
    font-weight: bold;
    font-size: .8rem;
}

.combination:last-child {
    border-bottom: none;
}

.combination img {
    display: inline-block;
    vertical-align: middle;
}

.combination p {
    margin-top: 5px;
    color: #333;
}

.modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            max-width: 80%;
            padding: 20px;
            background: rgba(0,0,0, 0.8);
            border-radius: 8px;
            text-align: center;
            color: white;
            z-index: 1000; /* Higher than other elements */
        }
    </style>