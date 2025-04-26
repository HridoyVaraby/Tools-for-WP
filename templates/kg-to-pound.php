<div class="tools-for-wp-container kg-to-pound">
    <div class="tool-header">
        <h3>Convert Kilograms to Pounds</h3>
        <p>Enter a weight in kilograms to convert it to pounds.</p>
    </div>
    
    <div class="tool-form">
        <div class="form-row">
            <div class="form-group">
                <label for="kg-value">Weight in Kilograms</label>
                <div class="input-with-icon">
                    <input type="number" id="kg-value" class="form-control" placeholder="Enter weight in kg" min="0" step="0.01" required>
                    <span class="input-icon">kg</span>
                </div>
            </div>
        </div>
        
        <button type="button" id="convert-kg-to-pound" class="btn btn-primary">Convert to Pounds</button>
    </div>
    
    <div class="tool-result" id="kg-to-pound-result" style="display: none;">
        <div class="result-box">
            <h4>Conversion Result</h4>
            <p class="result-value" id="pound-value"></p>
        </div>
    </div>
    
    <div class="tool-error" id="kg-to-pound-error" style="display: none;">
        <p>Please enter a valid weight value.</p>
    </div>
</div>