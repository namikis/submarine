<div class="modal_wrapper">
    <div class="modal">
        <div class="head_message">
            <p>本当に削除しますか？</p>
            <p>アカウントに関するすべての情報が消えます。</p>
        </div>

        <div class="button_wrapper">
            <a href="/account_delete_done" class="button">削除する</a>
        </div>
    </div>
</div>

<style>
    .modal_wrapper{
        width:100%;
        height:100%;
        z-index:98;
        background-color:rgba(0,0,0,0.5);
        position:absolute;
        top:0;
        display:none;
    }

    .modal{
        position:absolute;
        z-index:99;
        height:70%;
        width:70%;
        text-align:center;
        border:2px solid #F8A900;
        background-color:white;
        right:15%;
        top:100px;
        border-radius:10px;
    }

    .container{
        position:relative;
    }

    .head_message{
        margin-top:80px;
        font-size:35px;
    }

    .button_wrapper{
        margin-top:70px;
    }
</style>