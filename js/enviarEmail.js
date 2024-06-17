(function() {
    // https://dashboard.emailjs.com/admin/account
    emailjs.init({
      publicKey: "FfcJeXyADnJNVE0NG",
    });

})();

window.onload = function() {
    document.getElementById('formContacto').addEventListener('submit', function(event) {
        event.preventDefault();
        // these IDs from the previous steps
        emailjs.sendForm('service_hk7p1pm', 'template_wiip4bl', this)
            .then(() => {
                console.log('SUCCESS!');
            }, (error) => {
                console.log('FAILED...', error);
            });
    });
}