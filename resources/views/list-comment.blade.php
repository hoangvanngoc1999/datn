@foreach($comments as $com)
<div class="media">
    <a class="pull-left" href="#">
        <img class="media-object" src="https://cdn.icon-icons.com/icons2/1378/PNG/512/avatardefault_92824.png"
            alt="Image" width="60">
    </a>
    <div class="media-body">
        <h4 class="media-heading">{{$com->custom->name}}</h4>
        <p>{{$com->comment}}</p>
        <p>
            @if(Auth::guard('cus')->check())
            <a href="" class="btn btn-sm btn-primary btn-show-reply-form" data-id="{{$com->id}}">Trả lời</a>
            @else
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modelId">Vui lòng đăng nhập
                để trả lời</button>
            @endif
        </p>
        <form action="" method="post" role="form" style="display:none;" class="formReply form-reply-{{$com->id}}">
            <div class="form-group">
                <label for="">Nội dung bình luận</label>
                <textarea id="comment-reply-{{$com->id}}" class="form-control" rows="1"
                    placeholder="Nhập nội dung"></textarea>
            </div>
            <button type="button" data-id="{{$com->id}}" class=" btn btn-default btn-send-comment-reply">
                Gửi nội dung trả lời
            </button>
        </form>
        <!-- binh luan con -->
        @foreach($com->rep as $comrep)
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="https://cdn.icon-icons.com/icons2/1378/PNG/512/avatardefault_92824.png"
                    alt="Image" width="60">
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{$comrep->custom->name}}</h4>
                <p>{{$comrep->comment}}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endforeach