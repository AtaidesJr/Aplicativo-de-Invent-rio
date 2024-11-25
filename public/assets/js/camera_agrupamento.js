
function run() {

    let type = '';
    const reader = document.getElementById('reader');
    const cameraButton = document.getElementById('camerabtn');
    const stopButton = document.getElementById('stopbtn');
    const fileButton = document.getElementById('fileform');
    const resultText = document.getElementById('result');

    const html5QrCode = new Html5Qrcode("reader");

    cameraButton.addEventListener('click', function () {
        type = 'camera';

        resultText.parentElement.parentElement.style.display = 'none';
        cameraButton.innerHTML = 'Carregando...'
        cameraButton.disabled = true
        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                var cameraId = devices[0].id;

                const qrCodeSuccessCallback = (decodedText, decodedResult) => {
                    displayText(decodedText);

                    html5QrCode.stop().then(ignore => {
                        close()
                    })
                };

                const config = {
                    fps: 30,
                    qrbox: {
                        width: 130,
                        height: 130
                    }
                };

                html5QrCode.start({
                    facingMode: "environment"
                }, config, qrCodeSuccessCallback);
            }
        }).catch(err => {
            console.log(`Erro ao digitalizar. Razão: ${err}`)
        });
    });

    function displayText(text) {
        if (text.slice(0, 4) == 'http') {
            resultText.innerHTML = '<a href="' + text + '" target="_blank">' + text + '</a>';
        } else {

            // console.log(text);
            const parts = text.split('_');
            document.getElementById('deposito').value = parts[0];
            document.getElementById('secao').value = parts[1];
            document.getElementById('caixa').value = parts[2];
            document.getElementById('num_formulario').value = parts[3];

        }
        resultText.parentElement.parentElement.style.display = 'block';
    }


    function close() {
        reader.innerHTML = ''
        cameraButton.style.display = 'block'
        fileButton.style.display = 'block'
        stopButton.style.display = 'none'
        fileButton.reset()
    }

    stopButton.addEventListener('click', function () {
        if (html5QrCode.getState() == 2) {
            html5QrCode.stop().then(ignore => {
                close()
            })
        } else {
            close()
        }
    })

    new ResizeObserver(function (entries) {
        if (entries[0].contentRect.height > 0) {
            if (type != 'file') {
                cameraButton.style.display = 'none'
                fileButton.style.display = 'none'
                stopButton.style.display = 'block'
            }

            cameraButton.innerHTML = '<i class="glyphicon glyphicon-camera"></i> Abrir Câmera'
            cameraButton.disabled = false
        }
    }).observe(reader)

}
