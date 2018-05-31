(function() {
    const remarks = document.getElementById('remarks');

    // Truncate long text when remarks text reached over 50 characters
    if (remarks.innerText.length > 50) {
        remarks.innerText = `${remarks.innerText.substring(0,50)}...`;
    }
})();