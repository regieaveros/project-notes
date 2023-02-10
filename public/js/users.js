document.addEventListener('alpine:init', async () => {
    Alpine.store('users',
        {
            async store() {

                document.querySelector('p.name-error').innerHTML = "";
                document.querySelector('p.email-error').innerHTML = "";
                document.querySelector('p.password-error').innerHTML = "";
                document.getElementById("user-button-submit-create").disabled = true;
                document.getElementById("user-process-circle-create").classList.remove('hidden');

                axios.post("/store", 
                Object.fromEntries(new FormData(event.target)), 
                {
                    headers: {
                        "X-CSRF-Token": document.querySelector("input[name=_token]").value
                    }
                })
                .then(({data}) => {
                    if(data.status) {
                        window.location.href = data.redirect;
                        document.getElementById("user-form-create").reset();
                    } else {
                        document.getElementById("user-button-submit-create").disabled = false;
                        document.getElementById("user-process-circle-create").classList.add('hidden');
                        Object.keys(data.error).forEach(error => {
                            if(!data.error.name) {
                                document.querySelector("p.name-error").innerHTML = "";
                            } else {
                                document.querySelector("p."+error+"-error").innerHTML = data.error[error][0];
                            }
                            if(!data.error.email) {
                                document.querySelector("p.email-error").innerHTML = "";
                            } else {
                                document.querySelector("p."+error+"-error").innerHTML = data.error[error][0];
                            }
                            if(!data.error.password) {
                                document.querySelector("p.password-error").innerHTML = "";
                            } else {
                                document.querySelector("p."+error+"-error").innerHTML = data.error[error][0];
                            }
                        });
                    }
                });
            },
            async process() {

                document.getElementById("user-button-submit-login").disabled = true;
                document.getElementById("user-process-circle-login").classList.remove('hidden');
                document.querySelector("p.login-error").innerHTML = "";

                axios.post("/process", 
                Object.fromEntries(new FormData(event.target)), 
                {
                    headers: {
                        "X-CSRF-Token": document.querySelector("input[name=_token]").value
                    }
                })
                .then(({data}) => {
                    if(data.status) {
                        window.location.href = data.redirect;
                        document.getElementById("user-form-login").reset();
                    } else {
                        document.getElementById("user-button-submit-login").disabled = false;
                        document.getElementById("user-process-circle-login").classList.add('hidden');
                        document.querySelector("p.login-error").innerHTML = data.errors;
                    }
                });
            },
            async update() {

                document.querySelector('p.name-error').innerHTML = "";
                document.querySelector('p.email-error').innerHTML = "";
                document.querySelector('p.password-error').innerHTML = "";
                document.getElementById("user-button-submit-update").disabled = true;
                document.getElementById("user-process-circle-update").classList.remove('hidden');

                const profile = document.querySelector('input[name="profile"]');
                let dataForm = new FormData(event.target);
                dataForm.append('profile', profile.files[0])
                axios.post("/user/update", dataForm, {
                    headers: {
                        "X-CSRF-Token": document.querySelector("input[name=_token]").value
                    }
                })
                .then(({data}) => { 
                    if(data.status == false) {

                        document.getElementById("user-button-submit-update").disabled = false;
                        document.getElementById("user-process-circle-update").classList.add('hidden');

                        Object.keys(data.error).forEach(error => {
                            if(!data.error.name) {
                                document.querySelector("p.name-error").innerHTML = "";
                            } else {
                                document.querySelector("p."+error+"-error").innerHTML = data.error[error][0];
                            }
                            if(!data.error.email) {
                                document.querySelector("p.email-error").innerHTML = "";
                            } else {
                                document.querySelector("p."+error+"-error").innerHTML = data.error[error][0];
                            }
                            if(!data.error.password) {
                                document.querySelector("p.password-error").innerHTML = "";
                            } else {
                                document.querySelector("p."+error+"-error").innerHTML = data.error[error][0];
                            }
                        });
                    } else {
                        document.getElementById('user-logout').submit();
                    }
                });
            },
        }
    );
});