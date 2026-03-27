<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขงาน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5" style="max-width: 500px;">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h4 class="text-dark mb-4 text-center">แก้ไขรายการที่ต้องทำ</h4>

                <form action="/todos/{{ $todo->id }}" method="POST">
                    @csrf
                    @method('PUT') <div class="mb-3">
                        <label class="form-label text-muted">ชื่องาน</label>
                        <input type="text" name="title" class="form-control" value="{{ $todo->title }}" required autofocus>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <a href="/" class="btn btn-secondary w-50">ยกเลิก กลับหน้าแรก</a>
                        <button type="submit" class="btn btn-dark w-50">บันทึกการแก้ไข</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>