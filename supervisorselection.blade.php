<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Commettie - Admin Dashboard</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      display: flex;
      height: 100vh;
      background: #f7f8fc;
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      background: linear-gradient(180deg, #5fa8f5, #10253b);
      color: white;
      padding: 30px 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
    }

    .sidebar img {
      width: 120px;
      margin-bottom: 10px;
      border-radius: 50%;
    }

    .sidebar h2 {
      font-size: 25px;
      font-weight: 600;
      margin-bottom: 40px;
    }

    .menu {
      display: flex;
      flex-direction: column;
      gap: 25px;
      align-items: center;
      width: 100%;
    }

    .menu-btn {
      background: rgba(255, 255, 255, 0.25);
      border: none;
      color: white;
      font-size: 16px;
      padding: 12px 18px;
      border-radius: 10px;
      cursor: pointer;
      transition: 0.3s;
      width: 90%;
    }

    .menu-btn:hover {
      background: rgba(255, 255, 255, 0.45);
    }

    /* Add Icon */
    .add-container {
      position: relative;
      display: inline-block;
    }

    .add-icon {
      font-size: 50px;
      background: rgba(255, 255, 255, 0.25);
      border-radius: 50%;
      padding: 10px 14px;
      cursor: pointer;
      transition: 0.3s;
    }

    .add-icon:hover {
      background: rgba(255, 255, 255, 0.45);
    }

    .add-menu {
      display: none;
      position: absolute;
      top: 70px;
      left: 40px;
      background: white;
      color: #333;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      min-width: 180px;
      z-index: 100;
    }

    .add-menu button {
      background: none;
      border: none;
      width: 100%;
      padding: 12px;
      text-align: left;
      cursor: pointer;
      font-size: 15px;
      transition: 0.3s;
    }

    .add-menu button:hover {
      background: #f0f0f0;
    }

    .add-container:hover .add-menu {
      display: block;
    }

    /* Main section */
    .main-container {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    /* Topbar */
    .topbar {
      width: 100%;
      height: 80px;
      background: linear-gradient(to right, #5fa8f5, #10253b);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 30px;
      font-weight: 700;
      letter-spacing: 0.5px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    /* Main content */
    .main-content {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-top: 50px;
      padding: 40px;
    }

    /* Upload card */
    .upload-card {
      background: white;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      max-width: 700px;
      max-height: 500px;
    }

    .upload-card h2 {
      font-size: 22px;
      margin-bottom: 20px;
      color: #000;
    }

    .upload-card a {
      color: #3a77ff;
      text-decoration: none;
      font-weight: 500;
    }

    .file-input {
      display: flex;
      align-items: center;
      gap: 10px;
      margin: 15px 0;
    }

    .file-input input[type="file"] {
      display: none;
    }

    .file-input label {
      background: #e9ecef;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
    }

    .upload-btn {
      background: #265ed7;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 15px;
      transition: 0.3s;
    }

    .upload-btn:hover {
      background: #1746aa;
    }

    /* Note section */
    .note {
      border-top: 1px solid #ddd;
      margin-top: 25px;
      padding-top: 15px;
      color: #333;
    }

    .note h3 {
      font-size: 18px;
      margin-bottom: 8px;
    }

    .note ul {
      margin-left: 20px;
      list-style: disc;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <img src="{{ asset('images/logo.png') }}" alt="Logo">
    <h2>FYP Tracker</h2>

    <div class="menu">
      <div class="add-container">
        <div class="add-icon">+</div>
        <div class="add-menu">
          <button onclick="window.location.href='{{ route('admin.upload_student') }}'">Add Student</button>
          <button onclick="window.location.href='{{ route('admin.upload_teacher') }}'">Add Teacher</button>
          <button onclick="window.location.href='{{ route('admin.upload_commettie') }}'">Add Commettie</button>
        </div>
      </div>
      <button class="menu-btn" onclick="window.location.href='{{ route('admin.supervisorselection') }}'">Supervisor Selection</button>
    </div>
  </div>

  <div class="main-container">
    <!-- 🟦 Topbar -->
    <div class="topbar">Admin Dashboard</div>

    <!-- 🧩 Main Content -->
    <div class="main-content">
      <div class="upload-card">
           <div class="content-box">
            <h3>Supervisor Selection</h3>
            <p><strong>Select to exclude</strong></p>

            @if (session('success'))
                <p style="color:green; text-align:center;">{{ session('success') }}</p>
            @endif

            <form method="POST" action="">
                @csrf

                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Teacher Name</th>
                            <th>Domain</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $teacher)
                            <tr>
                                <td>
                                    <input type="checkbox" name="excluded_teachers[]" value="{{ $teacher->id }}" 
                                        {{ !$teacher->is_supervisor ? 'checked' : '' }}>
                                </td>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->domain }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="submit" class="btn-exclude">Exclude Selected</button>
            </form>
        </div>
        
    </div>
  </div>

  <script>
    const fileInput = document.getElementById('fileInput');
    const fileName = document.getElementById('fileName');

    fileInput.addEventListener('change', function() {
      fileName.textContent = this.files.length ? this.files[0].name : 'No file chosen';
    });
  </script>
</body>
</html>
