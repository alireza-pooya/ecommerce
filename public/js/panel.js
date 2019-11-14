// panel sidebar //
$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });
});

//panel date picker ///
$(document).ready(function () {
    $('input[name="dates"]').daterangepicker();
    $(function () {
        $('input[name="start_date"],[name="start_show"],[name="end_show"],[name="expire_date"]').daterangepicker({
            singleDatePicker: true,
            timePicker24Hour: true,
            timePicker: true,
            locale: {
                format: 'Y/MM/DD HH:mm:ss'
            }
        });
    });
});

//more than one select //
$(document).ready(function () {
    $(".select").select2({
        tags :true
    })
});

// smart wizard product panel //
$(document).ready(function(){

    // Smart Wizard
    $('#smartwizard').smartWizard({
        selected: 0,
        theme: 'dots',
        transitionEffect:'fade',
        showStepURLhash: true,
        toolbarSettings: {
            toolbarButtonPosition: 'end',
        }
    });


    // External Button Events
    $("#reset-btn").on("click", function() {
        // Reset wizard
        $('#smartwizard').smartWizard("reset");
        return true;
    });

    $("#prev-btn").on("click", function() {
        // Navigate previous
        $('#smartwizard').smartWizard("prev");
        return true;
    });

    $("#next-btn").on("click", function() {
        // Navigate next
        $('#smartwizard').smartWizard("next");
        return true;
    });

    $("#theme_selector").on("change", function() {
        // Change theme
        $('#smartwizard').smartWizard("theme", $(this).val());
        return true;
    });

    // Set selected theme on page refresh
    $("#theme_selector").change();
});

