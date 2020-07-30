<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <h1 style="
    position: absolute;
    left: 13%;
    font-size: inherit;
    top: 20%;
">愛してマスク？</h1>
    <div style="
    position: absolute;
    right: 5%;
    bottom: 4%;
    display: flex;
    font-size: small;
">
        <p>質問に答えて相性が良ければマスクを外せるよ</p>
        <p><a href="question.php">相性診断へ</a></p>
    </div>
</head>

<body style="
    width: auto;
    height: 500px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 93px;
">
    <h1 style="
    position: absolute;
    left: 13%;
    font-size: inherit;
    top: 20%;
">愛してマスク？</h1>
    <div style="
    position: absolute;
    right: 5%;
    bottom: 4%;
    display: flex;
    font-size: small;
">
        <p>質問に答えて相性が良ければマスクを外せるよ</p>
        <p><a href="question.php">相性診断へ</a></p>
    </div>





    <script src="js/ccv.js"></script>
    <script src="js/face.js"></script>
    <canvas id="img-canvas" width="800" height="1200" style="
    width: 400px;
"></canvas>
    <script>
        window.onload = function() {
            //写真の読み込み
            const image = new Image();
            image.src = './images/iwao.jpg';
            image.onload = function() {
                // 顔の検出
                var face_info = ccv.detect_objects({
                    "canvas": ccv.grayscale(ccv.pre(image)),
                    "cascade": cascade,
                    "interval": 5,
                    "min_neighbors": 1
                });
                // canvasに写真を表示3
                const img_canvas = document.getElementById("img-canvas");
                const canvas_2d = img_canvas.getContext("2d");
                img_canvas.width = image.width;
                img_canvas.height = image.height;
                canvas_2d.drawImage(image, 0, 0);

                // ひょっとこの表示
                const hyottoko = new Image();
                hyottoko.src = './images/hyottoko.jpg';

                hyottoko.onload = function() {
                    for (var i = 0; i < face_info.length; i++) {
                        canvas_2d.drawImage(hyottoko, face_info[i].x - 20, face_info[i].y - 20, face_info[i].width + 30, face_info[i].height + 30);
                    }
                }
                if (face_info.length === 0) {
                    console.log('ひょっとこにできないよ');
                }
            };
        };
    </script>







</body>

</html>