<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snake Game - Window 1</title>
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

        let snake = [{ x: 10, y: 10 }];
        let direction = { x: 1, y: 0 };
        let gameSpeed = 200;
        let otherWindow = { x: 600, y: 100, width: 400, height: 400 }; // Default position of the other window
        let thisWindow = { x: window.screenX, y: window.screenY, width: window.innerWidth, height: window.innerHeight };

        // Update this window's position periodically
        setInterval(() => {
            thisWindow = {
                x: window.screenX,
                y: window.screenY,
                width: window.innerWidth,
                height: window.innerHeight
            };
            channel.postMessage({ type: 'position_update', window: thisWindow });
        }, 100);

        // Listen for updates from the other window
        channel.onmessage = (event) => {
            const data = event.data;
            if (data.type === 'position_update') {
                otherWindow = data.window;
            }
            if (data.type === 'boundary_transfer') {
                snake = data.snake;
                direction = data.direction;
                adjustSnakeForEntry();
            }
        };

        function adjustSnakeForEntry() {
            // Adjust the snake's position for entering from the opposite boundary
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
            const head = { x: snake[0].x + direction.x, y: snake[0].y + direction.y };

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
                from_window: thisWindow
            });
        }

        window.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowUp' && direction.y !== 1) direction = { x: 0, y: -1 };
            if (e.key === 'ArrowDown' && direction.y !== -1) direction = { x: 0, y: 1 };
            if (e.key === 'ArrowLeft' && direction.x !== 1) direction = { x: -1, y: 0 };
            if (e.key === 'ArrowRight' && direction.x !== -1) direction = { x: 1, y: 0 };
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