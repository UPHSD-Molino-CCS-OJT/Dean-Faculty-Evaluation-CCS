document.addEventListener('DOMContentLoaded', () => {
    // Attach event listeners to all radio buttons with the calc-trigger class
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

            // Only update calculations if at least one item in the section is rated
            if (selected.length > 0) {
                let avg = sum / count;
                let weighted = avg * weight;

                // Update the section-specific summary rows
                section.querySelector('.section-total').innerText = sum;
                section.querySelector('.section-avg').innerText = avg.toFixed(2);
                section.querySelector('.section-weighted').innerText = weighted.toFixed(3);

                // Add to the grand totals shown at the top of the form
                grandTotalPoints += sum;
                grandWeightedSum += weighted;
            }
        });

        // Update the header summary boxes
        document.getElementById('grand-total-points').innerText = grandTotalPoints;
        document.getElementById('grand-overall-rating').innerText = grandWeightedSum.toFixed(2);
    }
});