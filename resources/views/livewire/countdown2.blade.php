<!-- countdown.blade.php -->
<div>
    <button class="btn btn-primary my-3" wire:click="start">Start/Restart</button>
    {{-- <div id="countdown">Countdown: <span id="timer"></span></div> --}}

    <button class="btn btn-primary my-3" wire:click="nothing">nothing</button>

    <button class="btn btn-primary my-3" wire:click="restart" id="restartButton" wire:ignore>Restart: <span id="timer">0:0 </span></button>

    <script>
        const restartButton = document.getElementById('restartButton');

        document.addEventListener('livewire:load', function() {
            var countdownInterval; // Declare the interval variable outside the event listener

            Livewire.on('startCountdown', function() {
                restartButton.disabled = true;

                // Clear the existing countdown interval if it exists
                if (countdownInterval) {
                    clearInterval(countdownInterval);
                }

                // Set the initial countdown time in seconds
                var countdownTime = 10; // 2 minutes

                // Get the timer element
                var timerElement = document.getElementById('timer');

                // Update the countdown every second
                countdownInterval = setInterval(function() {
                    var minutes = Math.floor(countdownTime / 60);
                    var seconds = countdownTime % 60;

                    // Display the countdown in the timer element
                    timerElement.textContent = minutes + ':' + (seconds < 10 ? '0' : '') + seconds;

                    // Decrease the countdown time
                    countdownTime--;

                    // Check if the countdown has reached zero
                    if (countdownTime < 0) {
                        clearInterval(countdownInterval);
                        timerElement.textContent = 'Time expired!';
                        restartButton.disabled = false;
                        //Livewire.emit('startCountdown'); // Restart the countdown
                    }
                }, 1000);
            });
        });
    </script>
</div>
