<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">Todo System</a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3">สวัสดี, {{ Auth::user()->name }}</span>

                <form action="/logout" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">ออกจากระบบ</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body py-4">
                <h4 class="text-dark mb-4 text-center">รายการที่ต้องทำ</h4>

                <form action="/todos" method="POST" class="mb-4">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="title" class="form-control" placeholder="พิมพ์งานที่ต้องทำ..." required autofocus>
                        <button type="submit" class="btn btn-dark">เพิ่มงาน</button>
                    </div>
                </form>

                <ul class="list-group text-start">
                    @forelse($todos as $todo)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $todo->title }}

                        <div class="d-flex gap-2">
                            <a href="/todos/{{ $todo->id }}/edit" class="btn btn-warning btn-sm">แก้ไข</a>

                            <form action="/todos/{{ $todo->id }}" method="POST" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">ลบ</button>
                            </form>
                        </div>
                    </li>
                    @empty
                    <div class="text-center text-muted py-3">
                        ยังไม่มีรายการที่ต้องทำ เริ่มต้นเพิ่มงานกันเลย!
                    </div>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</body>

</html>