<div class="tools-for-wp-container km-to-miles">
    <div class="tool-header">
        <h3>Convert Kilometers to Miles</h3>
        <p>Enter a distance in kilometers to convert it to miles.</p>
    </div>
    
    <div class="tool-form">
        <div class="form-row">
            <div class="form-group">
                <label for="km-value">Distance in Kilometers</label>
                <div class="input-with-icon">
                    <input type="number" id="km-value" class="form-control" placeholder="Enter distance in km" min="0" step="0.01" required>
                    <span class="input-icon">km</span>
                </div>
            </div>
        </div>
        
        <button type="button" id="convert-km-to-miles" class="btn btn-primary">Convert to Miles</button>
    </div>
    
    <div class="tool-result" id="km-to-miles-result" style="display: none;">
        <div class="result-box">
            <h4>Conversion Result</h4>
            <p class="result-value" id="miles-value"></p>
        </div>
    </div>
    
    <div class="tool-error" id="km-to-miles-error" style="display: none;">
        <p>Please enter a valid distance value.</p>
    </div>
</div>