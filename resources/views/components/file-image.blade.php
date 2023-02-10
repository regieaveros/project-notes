<div class="relative bg-cover bg-center w-28 h-28 rounded-full bg-no-repeat ring-4 ring-gray-400 ring-offset-2" id="imageSrc" style="background-image: url(@if(!empty(session('profile')))'<?= asset('uploads/images/'.session('profile')) ?>'@else 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png' @endif);">
    <div class="absolute top-20 right-[-10px]">
        <input
            x-data="{
                changeProfileImage: () => {
                    const form = document.getElementById('user-form-update');
                    const dataForm = new FormData(form);
                    const obj = dataForm.get('profile');
                    
                    if(obj.type.match('image.*')) {
                        var reader = new FileReader();
                        reader.readAsDataURL(obj);
                        reader.onload = function (e) {
                            var image = new Image();
                            image.src = e.target.result;
                            image.onload = function () {
                                document.getElementById('imageSrc').style.backgroundImage = 'url('+image.src+')';
                            }
                        }
                    } else {
                        document.getElementById('imageSrc').style.backgroundImage = 'url(https://care-to.southernleytestateu.edu.ph/wp-content/uploads/2022/06/NoImageFound.jpg.png)';
                        document.querySelector('input[type=file]').value = '';
                    }
                }
            }"
            @change="changeProfileImage()"
            class="hidden"
            type="file"
            id="upload"
            name="profile" 
            accept="image/*"
        >
        <label class="block cursor-pointer transition-all duration-300 hover:scale-90 focus:scale-100 active:scale-90 bg-cyan-500 text-gray-200 rounded-full text-md py-[0.2rem] px-[0.5rem]" for="upload">
            <i class="fa-solid fa-image"></i>
        </label>
    </div>
</div>