@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/post.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')
<div class="post">
    <div class="post-main">
        <div class="post-content">
            <h1 class="post-title">(再レビュー)今回のご利用はいかがでしたか？</h1>
            <div class="post-item">
                <form action="/detail" method="post">
                    @csrf
                    <img class="store-img" src="{{$store['image']}}" alt="" />
                    <p class="store-name">{{$store['store_name']}}</p>
                    <p class="store-name__tag">#{{$store['location']}} #{{$store['category']}}</p>
                    <input type="hidden" name="id" value="{{$store['id']}}">
                    <input type="hidden" name="store_name" value="{{$store['store_name']}}">
                    <input type="hidden" name="image" value="{{$store['image']}}">
                    <input type="hidden" name="location" value="{{$store['location']}}">
                    <input type="hidden" name="category" value="{{$store['category']}}">
                    <input type="hidden" name="explanation" value="{{$store['explanation']}}">
                    <div class="post-item__tag">
                        <button type="submit" class="store-content__cat">詳しくみる</button>
                        @if ($liked)
                        <i class="fa-solid fa-heart" style='color:red'></i>
                        @else
                        <i class="fa-solid fa-heart" style='color:gray'></i>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="post-detail">
        @error('post')
        <p class="error">{{ $message }}</p>
        @enderror
        <form action="/post_edit" method="POST" enctype="multipart/form-data">
            @csrf
            <h2>体験を評価してください</h2>
            <div class="post-form">
                <input class="post-tag" id="star5" name="post" type="radio" value="5" onchange="toggleSubmitButton()">
                <label class="post-label" for="star5"><i class="fa-solid fa-star"></i></label>
                <input class="post-tag" id="star4" name="post" type="radio" value="4" onchange="toggleSubmitButton()">
                <label class="post-label" for="star4"><i class="fa-solid fa-star"></i></label>
                <input class="post-tag" id="star3" name="post" type="radio" value="3" onchange="toggleSubmitButton()">
                <label class="post-label" for="star3"><i class="fa-solid fa-star"></i></label>
                <input class="post-tag" id="star2" name="post" type="radio" value="2" onchange="toggleSubmitButton()">
                <label class="post-label" for="star2"><i class="fa-solid fa-star"></i></label>
                <input class="post-tag" id="star1" name="post" type="radio" value="1" onchange="toggleSubmitButton()">
                <label class="post-label" for="star1"><i class="fa-solid fa-star"></i></label>
            </div>
            <script>
                function toggleSubmitButton() {
                    const isChecked = document.querySelector('input[name="post"]:checked');
                    document.querySelector('.post_submit').disabled = !isChecked;
                }
            </script>
            <p>口コミを投稿</p>
            <div class="post-text">
                <textarea class="post-text__area" name="description" cols="80" rows="5">
                    <?php print_r($post['description']) ?>
                </textarea></br>
                <small class="post-text__repletion">0/400 (最高文字数)</small>
            </div>
            <p>画像の追加</p>
            @error('image')
            <div class="error">{{ $message }}</div>
            @enderror
            <div class="upload_area" id="uploadArea">
                <input type="file" name="image" class="input_file" accept="image/png,image/jpeg" id="fileInput" />
                <div class="input-text__area">
                    <?php print_r($post['image']) ?>
                    <div class="input-text">クリックして写真を追加</div>
                    <p class="input-explanation">またはドラックアンドドロップ</p>
                </div>
                <div id="preview"></div>
                <p id="errorMessage" style="color: red;"></p>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const uploadArea = document.getElementById('uploadArea');
                    const fileInput = document.getElementById('fileInput');
                    const preview = document.getElementById('preview');
                    const errorMessage = document.getElementById('errorMessage');

                    uploadArea.addEventListener('dragover', (event) => {
                        event.preventDefault();
                        uploadArea.classList.add('dragging');
                    });

                    uploadArea.addEventListener('dragleave', () => {
                        uploadArea.classList.remove('dragging');
                    });

                    uploadArea.addEventListener('drop', (event) => {
                        event.preventDefault();
                        uploadArea.classList.remove('dragging');
                        const files = event.dataTransfer.files;
                        handleFiles(files);
                    });

                    fileInput.addEventListener('change', (event) => {
                        const files = event.target.files;
                        handleFiles(files);
                    });

                    function handleFiles(files) {
                        if (files.length > 0) {
                            const file = files[0];
                            if (file.type === 'image/jpeg' || file.type === 'image/png') {
                                errorMessage.textContent = '';
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    preview.innerHTML = `<img src="${e.target.result}" alt="Image Preview" />`;
                                    const dataTransfer = new DataTransfer();
                                    dataTransfer.items.add(new File([file], file.name, { type: file.type }));
                                    fileInput.files = dataTransfer.files;
                                };
                                reader.readAsDataURL(file);
                            } else {
                                errorMessage.textContent = 'JPEGまたはPNG形式のファイルを選択してください。';
                                preview.innerHTML = '';
                            }
                        }
                    }
                });
            </script>
            <div class="post_button">
                <input type="hidden" name="id" value="{{$post->id}}">
                <button type="submit" class="post_submit" disabled>口コミを投稿</button>
            </div>
        </form>
    </div>
</div>
@endsection