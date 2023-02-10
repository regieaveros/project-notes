document.addEventListener('alpine:init', async () => {
    Alpine.store('notes',
        {
            async show(id) {
                const url = window.location.origin+'/uploads/images/';
                document.getElementById('modal-data').classList.add('hidden');
                document.getElementById('modal-loading').classList.remove('hidden');

                axios.get("/show/"+id,
                {
                    headers: {
                        "X-CSRF-Token": document.querySelector("input[name=_token]").value
                    }
                })
                .then(({data}) => {
                    document.getElementById('modal-data').classList.remove('hidden');
                    document.getElementById('modal-loading').classList.add('hidden');
                    document.getElementById('name').innerHTML = data.result.name;
                    document.getElementById('date').innerHTML = moment(data.result.created_at).format("dddd, MMMM D, YYYY, h:mm a");
                    document.getElementById('title').innerHTML = data.result.title;
                    document.getElementById('message').innerHTML = data.result.message;
                    if(data.result.profile) {
                        document.getElementById('profile-image').style.backgroundImage = 'url('+url+data.result.profile+')';
                    }
                });
            },
            async store() {
                document.getElementById("note-button-submit-add").disabled = true;
                document.getElementById("note-process-circle-add").classList.remove('hidden');
                
                axios.post("/note/store", 
                Object.fromEntries(new FormData(event.target)), 
                {
                    headers: {
                        "X-CSRF-Token": document.querySelector("input[name=_token]").value
                    }
                })
                .then(({data}) => {
                    if(data.status) {
                        window.location.href = data.redirect;
                        document.getElementById("note-form-create").reset();
                    } else {
                        document.getElementById("note-button-submit-add").disabled = false;
                        document.getElementById("note-process-circle-add").classList.add('hidden');
                        Object.keys(data.error).forEach(error => {
                            if(!data.error.title) {
                                document.querySelector("p.title-error").innerHTML = "";
                            } else {
                                document.querySelector("p."+error+"-error").innerHTML = data.error[error][0];
                            }
                            if(!data.error.message) {
                                document.querySelector("p.message-error").innerHTML = "";
                            } else {
                                document.querySelector("p."+error+"-error").innerHTML = data.error[error][0];
                            }
                        });
                    }
                });
            },
            async update() {
                document.getElementById("note-button-submit-edit").disabled = true;
                document.getElementById("note-process-circle-edit").classList.remove('hidden');
                
                axios.post("/note/update", 
                Object.fromEntries(new FormData(event.target)), 
                {
                    headers: {
                        "X-CSRF-Token": document.querySelector("input[name=_token]").value
                    }
                })
                .then(({data}) => {
                    if(data.status) {
                        window.location.href = data.redirect;
                    } else {
                        document.getElementById("note-button-submit-edit").disabled = false;
                        document.getElementById("note-process-circle-edit").classList.add('hidden');
                        Object.keys(data.error).forEach(error => {
                            if(!data.error['edit-title']) {
                                document.querySelector("p.edit-title-error").innerHTML = "";
                            } else {
                                document.querySelector("p."+error+"-error").innerHTML = data.error[error][0];
                            }
                            if(!data.error['edit-message']) {
                                document.querySelector("p.edit-message-error").innerHTML = "";
                            } else {
                                document.querySelector("p."+error+"-error").innerHTML = data.error[error][0];
                            }
                        });
                    }
                });
            },
            async destroy(id) {
                const button_delete = "note-button-submit-delete-"+id;
                const process_delete = "note-process-circle-add-"+id;
                document.getElementById(button_delete).disabled = true;
                document.getElementById(process_delete).classList.remove('hidden');
                
                axios.post("/note/destroy/"+id, 
                Object.fromEntries(new FormData(event.target)), 
                {
                    headers: {
                        "X-CSRF-Token": document.querySelector("input[name=_token]").value
                    }
                })
                .then(({data}) => {
                    window.location.href = data.redirect; 
                });
            },
            async filter() {
                let checkedValue;
                const search = document.querySelector('input[name=search]').value;
                const searchColor = document.querySelector('input[name=search-color]:checked');

                if(searchColor === null) {
                    checkedValue = "";
                } else {
                    checkedValue = searchColor.value;
                }
                
                localStorage.setItem('search', search);
                localStorage.setItem('color', checkedValue);
                
            },
        }
    );
});