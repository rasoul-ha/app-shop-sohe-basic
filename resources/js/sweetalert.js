function deleteData(type, id, title) {
    Swal.fire({
        title: 'R u sure?',
        text:`You cannot return ${type} " ${title} "!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText:'Yes, delete it!',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#6169d0',
        cancelButtonColor: '#d54e69'

    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();

        }
    })
}

function successMessage(message) {
    Swal.fire({
        text: message,
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok',
    })
}
function errorMessage(message) {
    Swal.fire({
        text: message,
        icon: 'error',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK',
    })
}

function deleteImage(imageId) {
    Swal.fire({
        title: 'R u sure?',
        text: `You cannot return this image!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText:'Yes, delete it!',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#6169d0',
        cancelButtonColor: '#d54e69'

    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/api/images/remove/${imageId}`)
        }
    })
}