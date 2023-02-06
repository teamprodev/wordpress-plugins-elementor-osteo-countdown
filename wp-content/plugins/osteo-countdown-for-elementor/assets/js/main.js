(function($) {
    "use strict";

    $(window).on("elementor/frontend/init", function() {
        elementorFrontend.hooks.addAction("frontend/element_ready/Osteo_Flip_Clock_Countdown.default", function($scope) {
            $scope.find(".clock-1").each(function() {
                var element = $(this)[0];
                var clock_format = $(this).data('clock-format');
                var clock;
                if (element) {
                    clock = $(element).FlipClock({
                        clockFace: clock_format,
                    });
                }
            });
            $scope.find(".clock-2").each(function() {
                var element = $(this)[0];
                var now = new Date();
                var targetTime = $(this).data('target-time');
                var targetDateObject = new Date(targetTime);
                var difference = (targetDateObject.getTime() - now.getTime()) / 1000;
                if (element) {
                    var clock = $(element).FlipClock({
                        clockFace: 'DailyCounter',
                    });
                    clock.setTime(difference);
                    clock.setCountdown(true);
                }
            });
            $scope.find(".clock-3").each(function() {
                var element = $(this)[0];
                var countdownValue = $(this).data('countdown');
                if (element) {
                    var clock = $(element).FlipClock(countdownValue, {
                        clockFace: 'Counter',
                    });
                    setInterval(function() {
                        clock.decrement();
                    }, 1000);
                }
            })
        });
        elementorFrontend.hooks.addAction("frontend/element_ready/Osteo_Final_Countdown.default", function($scope) {
            $scope.find(".countdown").each(function() {
                var element = $(this)[0];
                var date = $(this).data("date");
                if (element) {
                    $(element).countdown(date, function(event) {
                        var $this = $(this).html(event.strftime("" + '<div class="count">%w <span>Weeks</span></div>  ' + '<div class="count">%d <span>Days</span></div>  ' + '<div class="count">%H <span>Hours</span></div>  ' + '<div class="count">%M <span>Minute</span></div>  ' + '<div class="count">%S <span>Second</span></div> '))
                    })
                }
            })
        });
    })
})(jQuery);