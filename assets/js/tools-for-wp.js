/**
 * Tools for WP - Main JavaScript
 * Version: 1.0.0
 */

(function($) {
    'use strict';

    // Initialize when document is ready
    $(document).ready(function() {
        // BMI Calculator
        initBmiCalculator();
        
        // KG to Pound Converter
        initKgToPoundConverter();
        
        // KM to Miles Converter
        initKmToMilesConverter();
    });

    /**
     * Initialize BMI Calculator
     */
    function initBmiCalculator() {
        const calculateBtn = $('#calculate-bmi');
        
        if (calculateBtn.length) {
            calculateBtn.on('click', function() {
                const weight = parseFloat($('#bmi-weight').val());
                const height = parseFloat($('#bmi-height').val());
                
                if (isNaN(weight) || isNaN(height) || weight <= 0 || height <= 0) {
                    $('#bmi-result').hide();
                    $('#bmi-error').show();
                    return;
                }
                
                // Convert height from cm to meters
                const heightInMeters = height / 100;
                
                // Calculate BMI: weight (kg) / (height (m) * height (m))
                const bmi = weight / (heightInMeters * heightInMeters);
                const roundedBmi = Math.round(bmi * 10) / 10;
                
                // Determine BMI category
                let category = '';
                if (bmi < 18.5) {
                    category = 'Underweight';
                } else if (bmi >= 18.5 && bmi < 25) {
                    category = 'Normal weight';
                } else if (bmi >= 25 && bmi < 30) {
                    category = 'Overweight';
                } else {
                    category = 'Obesity';
                }
                
                // Display result
                $('#bmi-value').text(roundedBmi);
                $('#bmi-category').text(category);
                $('#bmi-error').hide();
                $('#bmi-result').show();
            });
        }
    }

    /**
     * Initialize KG to Pound Converter
     */
    function initKgToPoundConverter() {
        const convertBtn = $('#convert-kg-to-pound');
        
        if (convertBtn.length) {
            convertBtn.on('click', function() {
                const kgValue = parseFloat($('#kg-value').val());
                
                if (isNaN(kgValue) || kgValue < 0) {
                    $('#kg-to-pound-result').hide();
                    $('#kg-to-pound-error').show();
                    return;
                }
                
                // Convert kg to pounds (1 kg = 2.20462 pounds)
                const poundValue = kgValue * 2.20462;
                const roundedPoundValue = Math.round(poundValue * 100) / 100;
                
                // Display result
                $('#pound-value').text(kgValue + ' kg = ' + roundedPoundValue + ' pounds');
                $('#kg-to-pound-error').hide();
                $('#kg-to-pound-result').show();
            });
        }
    }

    /**
     * Initialize KM to Miles Converter
     */
    function initKmToMilesConverter() {
        const convertBtn = $('#convert-km-to-miles');
        
        if (convertBtn.length) {
            convertBtn.on('click', function() {
                const kmValue = parseFloat($('#km-value').val());
                
                if (isNaN(kmValue) || kmValue < 0) {
                    $('#km-to-miles-result').hide();
                    $('#km-to-miles-error').show();
                    return;
                }
                
                // Convert km to miles (1 km = 0.621371 miles)
                const milesValue = kmValue * 0.621371;
                const roundedMilesValue = Math.round(milesValue * 100) / 100;
                
                // Display result
                $('#miles-value').text(kmValue + ' km = ' + roundedMilesValue + ' miles');
                $('#km-to-miles-error').hide();
                $('#km-to-miles-result').show();
            });
        }
    }

})(jQuery);