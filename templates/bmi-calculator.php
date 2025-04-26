<div class="tools-for-wp-container bmi-calculator">
    <div class="tool-header">
        <h3>Calculate Your Body Mass Index (BMI)</h3>
        <p>Enter your weight and height to calculate your BMI.</p>
    </div>
    
    <div class="tool-form">
        <div class="form-row">
            <div class="form-group">
                <label for="bmi-weight">Weight (kg)</label>
                <input type="number" id="bmi-weight" class="form-control" placeholder="Enter weight" min="1" step="0.1" required>
            </div>
            
            <div class="form-group">
                <label for="bmi-height">Height (cm)</label>
                <input type="number" id="bmi-height" class="form-control" placeholder="Enter height" min="1" step="0.1" required>
            </div>
        </div>
        
        <button type="button" id="calculate-bmi" class="btn btn-primary">Calculate BMI</button>
    </div>
    
    <div class="tool-result" id="bmi-result" style="display: none;">
        <div class="result-box">
            <h4>Your BMI Result</h4>
            <p class="result-value" id="bmi-value"></p>
            <p class="result-category" id="bmi-category"></p>
        </div>
    </div>
    
    <div class="tool-error" id="bmi-error" style="display: none;">
        <p>Please enter valid weight and height values.</p>
    </div>
</div>