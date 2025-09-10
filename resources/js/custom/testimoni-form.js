document.addEventListener('DOMContentLoaded', function(){
    const select = document.getElementById('status_diterima');
    const diterimaField = document.getElementById('field-diterima');

    select.addEventListener('change', function(){
        if(this.value === '1'){
            diterimaField.classList.remove('hidden');
        } else{
            diterimaField.classList.add('hidden');
        }
    });
})