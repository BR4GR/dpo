<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snake Game</title>
    <style>
        canvas {
            border: 2px solid black;
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <canvas id="gameCanvas" width="400" height="400"></canvas>
    <script>
        const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');
        const channel = new BroadcastChannel('snake_game');

        // Assign a unique ID to this window
        const windowId = Math.random().toString(36).substr(2, 5);

        let isMaster = false; // Tracks whether this window is the master
        let masterWindowId = null;
        let snake = []; // Snake state
        let direction = {
            x: 1,
            y: 0
        };
        let gameSpeed = 200;
        let otherWindow = {
            id: null,
            x: 600,
            y: 100,
            width: 400,
            height: 400
        };
        let thisWindow = {
            id: windowId,
            x: window.screenX,
            y: window.screenY,
            width: window.innerWidth,
            height: window.innerHeight
        };

        // Broadcast this window's position and check for master
        setInterval(() => {
            thisWindow = {
                id: windowId,
                x: window.screenX,
                y: window.screenY,
                width: window.innerWidth,
                height: window.innerHeight
            };
            channel.postMessage({
                type: 'position_update',
                window: thisWindow
            });

            if (isMaster) {
                channel.postMessage({
                    type: 'state_update',
                    snake: snake,
                    direction: direction
                });
            }
        }, 100);

        // Initialize the snake only if this is the master window
        function initializeSnake() {
            snake = [{
                x: 10,
                y: 10
            }];
        }

        // Listen for messages on the BroadcastChannel
        channel.onmessage = (event) => {
            const data = event.data;

            if (data.type === 'position_update' && data.window.id !== thisWindow.id) {
                otherWindow = data.window; // Update the other window's position
            }

            if (data.type === 'master_announcement') {
                masterWindowId = data.masterId;
                if (masterWindowId === windowId) {
                    isMaster = true;
                    initializeSnake(); // Only the master initializes the snake
                }
            }

            if (data.type === 'state_update' && !isMaster) {
                // Sync snake state if this is not the master
                snake = data.snake;
                direction = data.direction;
            }

            if (data.type === 'boundary_transfer' && data.to_window.id === thisWindow.id) {
                snake = data.snake;
                direction = data.direction;
                adjustSnakeForEntry();
            }
        };

        // Announce this window as the master if no other master exists
        channel.postMessage({
            type: 'master_announcement',
            masterId: windowId
        });

        function adjustSnakeForEntry() {
            if (otherWindow.x > thisWindow.x) {
                snake.forEach((segment) => segment.x = 0); // Enter from the left
            } else {
                snake.forEach((segment) => segment.x = Math.floor(canvas.width / 20) - 1); // Enter from the right
            }
        }

        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = 'green';
            snake.forEach((part) => {
                ctx.fillRect(part.x * 20, part.y * 20, 20, 20);
            });
        }

        function update() {
            if (!isMaster) return; // Only the master updates the game state

            const head = {
                x: snake[0].x + direction.x,
                y: snake[0].y + direction.y
            };

            // Check if the snake leaves the boundary
            if (head.x < 0 || head.x >= canvas.width / 20 || head.y < 0 || head.y >= canvas.height / 20) {
                transferSnake();
                return;
            }

            snake.unshift(head);
            snake.pop();
        }

        function transferSnake() {
            channel.postMessage({
                type: 'boundary_transfer',
                snake: snake,
                direction: direction,
                from_window: thisWindow,
                to_window: otherWindow
            });
        }

        window.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowUp' && direction.y !== 1) direction = {
                x: 0,
                y: -1
            };
            if (e.key === 'ArrowDown' && direction.y !== -1) direction = {
                x: 0,
                y: 1
            };
            if (e.key === 'ArrowLeft' && direction.x !== 1) direction = {
                x: -1,
                y: 0
            };
            if (e.key === 'ArrowRight' && direction.x !== -1) direction = {
                x: 1,
                y: 0
            };
        });

        function gameLoop() {
            update();
            draw();
            setTimeout(gameLoop, gameSpeed);
        }

        gameLoop();
    </script>
</body>

</html>