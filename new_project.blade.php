<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>New Project - FYP Tracker</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      display: flex;
      height: 100vh;
      overflow: hidden;
      background: #f8f9fd;
    }

    /* Sidebar */
    .sidebar {
      width: 15%;
      background: linear-gradient(to bottom, #1e3c72, #1b2b47ff);
      padding: 20px;
      text-align: center;
      color: white;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
    }

    .sidebar img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin-bottom: 10px;
      margin-top: 10px;
    }

    .sidebar h2 {
      font-size: 20px;
      margin-bottom: 20px;
    }

    .sidebar a {
      display: block;
      margin: 25px 0;
      text-decoration: none;
      padding:21px;
      font-size: 17px;
      color: #fff;
      transition: 0.3s;
    }

    .sidebar a:hover {
      color: #ffd700;
      text-decoration: underline;
    }

    /* Topbar */
    .topbar {
      position: fixed;
      top: 0;
      left: 15%;
      width: 85%;
      height: 60px;
      background: linear-gradient(to bottom, #1e3c72, #1b2b47ff);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      font-weight: bold;
      z-index: 10;
    }

    /* Main scrollable content */
    .main {
      margin-left: 15%;
      margin-top: 60px;
      width: 85%;
      height: calc(100vh - 60px);
      overflow-y: auto;
      padding: 30px 60px;
    }

    .form-container {
      background: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
    }

    sidebar.h2 {
      text-align: center;
      color: #ffffff;
      margin-bottom: 20px;
    }

    .rules {
      background: #e9eef7;
      padding: 15px 25px;
      border-radius: 12px;
      margin-bottom: 25px;
      font-size: 15px;
      color: #333;
    }

    .toggle {
      display: flex;
      justify-content: center;
      gap: 30px;
      margin-bottom: 25px;
    }

    .toggle label {
      font-size: 18px;
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
    }

    input[type="radio"] {
      transform: scale(1.3);
      accent-color: #0a3478;
    }

    .form-group {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin: 15px 0;
    }

    .form-group label {
      width: 25%;
      font-weight: 600;
    }

    .form-group input,
    .form-group textarea {
      width: 70%;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 15px;
    }

    textarea {
      resize: none;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    th, td {
      border: 1px solid #ddd;
      text-align: center;
      padding: 8px;
    }

    th {
      background: #0a3478;
      color: white;
    }

    td input, td select {
      width: 90%;
      padding: 6px;
      border-radius: 5px;
      border: 1px solid #ccc;
      text-align: center;
    }

    .submit-btn {
      display: block;
      width: 25%;
      margin: 30px auto 0;
      background: #0a3478;
      color: white;
      font-size: 18px;
      border: none;
      border-radius: 10px;
      padding: 12px;
      cursor: pointer;
      transition: 0.3s;
    }

    .submit-btn:hover {
      background: #07285f;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }

      .topbar {
        left: 0;
        width: 100%;
      }

      .main {
        margin-left: 0;
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <img src="{{ asset('images/logo.png') }}" alt="Logo">
    <h2>FYP Tracker</h2>
    <a href="{{route('student')}}">Create Group</a>
    <a href="{{ route('project') }}">Create Project</a>
    <a href="{{route('meeting')}}">Meeting Schedule</a>
    <a href="#">Notifications</a>
  </div>

  <!-- Topbar -->
  <div class="topbar">Student Dashboard</div>

  <!-- Scrollable Main -->
  <div class="main">
    <div class="form-container">
      <h2>Project Selection Form</h2>

      <div class="rules">
        <strong>Rules for creating Groups:</strong>
        <ol>
          <li>Each group will consist of 5 members.</li>
          <li>Group members will be differentiated on the basis of Technology.</li>
        </ol>
      </div>

      <div class="toggle">
        <label><input type="radio" name="project_type" value="new" checked> New Projects</label>
        <label><input type="radio" name="project_type" value="select"  onclick="window.location='{{route('project')}}'"> Select Projects</label>
      </div>

      <div class="form-group">
        <label for="title">Project Title:</label>
        <input type="text" id="title" name="title" placeholder="Enter Project Title">
      </div>

      <div class="form-group">
        <label for="objectives">Objectives:</label>
        <textarea id="objectives" name="objectives" rows="3" placeholder="Write project objectives..."></textarea>
      </div>

      <h3>Group Members</h3>
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>NUN#</th>
            <th>Name</th>
            <th>CGPA</th>
            <th>Technology</th>
          </tr>
        </thead>
        <tbody id="group-table-body">
          @for ($i = 1; $i <= 5; $i++)
          <tr>
            <td>{{ $i }}</td>
            <td><input type="text" name="nun[]" placeholder="e.g., 232-NUM-020{{ $i }}"></td>
            <td><input type="text" name="name[]" placeholder="Enter Name"></td>
            <td><input type="text" name="cgpa[]" placeholder="e.g., 3.45"></td>
            <td>
              <select name="technology[]">
                
                <option>Web</option>
                <option>Flutter</option>
                <option>React Native</option>
                <option>Android</option>
                <option>iOS</option>
              </select>
            </td>
          </tr>
          @endfor
        </tbody>
      </table>

      <button class="submit-btn">Submit</button>
    </div>
  </div>
</body>
</html>
