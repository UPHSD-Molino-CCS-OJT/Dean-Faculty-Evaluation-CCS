document.addEventListener('DOMContentLoaded', () => {
    
    // 1. SIGNATURE LOGIC: Listen for faculty selection changes
    const facultySelect = document.getElementById('faculty_select');
    const signatureName = document.getElementById('sig_name');

    if (facultySelect && signatureName) {
        facultySelect.addEventListener('change', (e) => {
            signatureName.innerText = e.target.value;
        });
    }

    // 2. CALCULATION LOGIC: Attach event listeners to all radio buttons
    document.querySelectorAll('.calc-trigger').forEach(input => {
        input.addEventListener('change', calculateAll);
    });

    function calculateAll() {
        let grandTotalPoints = 0;
        let grandWeightedSum = 0;

        // Loop through each evaluation section (I, II, III, IV, V)
        document.querySelectorAll('.section-block').forEach(section => {
            const weight = parseFloat(section.dataset.weight);
            const count = parseInt(section.dataset.count);
            const selected = section.querySelectorAll('input:checked');
            
            let sum = 0;
            selected.forEach(r => sum += parseInt(r.value));

            // Only update calculations if items are rated
            if (selected.length > 0) {
                let avg = sum / count;
                let weighted = avg * weight;

                // Update the section-specific summary rows if they exist in the HTML
                const totalEl = section.querySelector('.section-total');
                const avgEl = section.querySelector('.section-avg');
                const weightedEl = section.querySelector('.section-weighted');

                if (totalEl) totalEl.innerText = sum;
                if (avgEl) avgEl.innerText = avg.toFixed(2);
                if (weightedEl) weightedEl.innerText = weighted.toFixed(3);

                // Add to the grand totals
                grandTotalPoints += sum;
                grandWeightedSum += weighted;
            }
        });

        // Update the header summary boxes
        const grandPointsEl = document.getElementById('grand-total-points');
        const grandRatingEl = document.getElementById('grand-overall-rating');

        if (grandPointsEl) grandPointsEl.innerText = grandTotalPoints;
        if (grandRatingEl) grandRatingEl.innerText = grandWeightedSum.toFixed(2);
    }
});