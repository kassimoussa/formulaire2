<!-- resources/views/livewire/countdown.blade.php -->

<div>
    <button class="btn btn-primary" wire:click="start">OK</button>
    <div id="countdown">Countdown: <span id="timer"></span></div>

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('startCountdown', function() {
                // Set the countdown time in seconds
                var countdownTime = 120; // 5 minutes

                // Get the timer element
                var timerElement = document.getElementById('timer');

                // Update the countdown every second
                var countdownInterval = setInterval(function() {
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
                    }
                }, 1000);
            });
        });
    </script>


</div>
