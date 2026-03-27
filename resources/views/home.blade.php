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
            <div class="card-body text-center py-5">
                <h3 class="text-muted">ยินดีต้อนรับเข้าสู่ระบบ</h3>
                <p>เดี๋ยวเราจะมาทำระบบเพิ่ม Todo ของคุณที่หน้านี้กันครับ!</p>
            </div>
        </div>
    </div>
</body>
</html>