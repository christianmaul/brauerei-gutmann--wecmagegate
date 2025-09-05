const submitAgeGateForm = () => {
    const form = document.getElementById('cm-form--agegate');

    if (!form) {
        return;
    }

    const statusInputs = form.querySelectorAll('input[name="wecmagegate[status]"]');
    statusInputs.forEach(input => {
        input.addEventListener('change', () => {
            form.submit();
        });
    });
};

document.addEventListener('DOMContentLoaded', submitAgeGateForm);