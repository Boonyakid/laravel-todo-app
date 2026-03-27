<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px; border: none; border-radius: 10px;">
            <h4 class="text-center mb-4 text-dark">เข้าสู่ระบบ</h4>

            @if(session('error'))
            <div class="alert alert-danger py-2">{{ session('error') }}</div>
            @endif

            <form action="/login" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label text-muted">อีเมล</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted">รหัสผ่าน</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-dark w-100 mb-3">เข้าสู่ระบบ</button>
                <div class="text-center">
                    <a href="/register" class="text-decoration-none text-secondary">ยังไม่มีบัญชี? สมัครสมาชิก</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>