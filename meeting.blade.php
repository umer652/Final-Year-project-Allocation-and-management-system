<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meeting Schedule - FYP Tracker</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background: #f3f4f6;
      display: flex;
    }

    /* Sidebar */
    .sidebar {
      width: 240px;
      height: 100vh;
      background: linear-gradient(to bottom, #1e3c72, #1b2b47ff);
      color: white;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding-top: 30px;
      position: fixed;
      top: 0;
      left: 0;
    }

    .sidebar img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin-bottom: 20px;
    }

    .sidebar h2 {
      font-size: 20px;
      margin-bottom: 30px;
      font-weight: bold;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-top: 40px;
      text-decoration: none;
      font-size: 18px;
      color: #fff;
      transition: 0.3s;
    }

    .sidebar a:hover {
      color: #ffeb3b;
    }

    /* ✅ Topbar fixed and aligned with sidebar */
    .topbar {
      position: fixed;
      top: 0;
      left: 240px;
      right: 0;
      height: 60px;
      background: linear-gradient(to bottom, #1e3c72, #1b2b47ff);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      font-weight: bold;
      z-index: 1000;
    }

    /* Main content */
    .main-content {
      margin-left: 260px;
      margin-top: 80px; /* space for topbar */
      padding: 30px;
      width: calc(100% - 260px);
    }

    .main-content h1 {
      font-size: 26px;
      color: #222;
      margin-bottom: 25px;
      text-align: center;
    }

    /* Toggle buttons */
    .toggle-group {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }

    .toggle-group label {
      background: #d9d9d9;
      padding: 8px 16px;
      border-radius: 20px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      user-select: none;
    }

    .toggle-group input[type="radio"] {
      accent-color: #0077b6;
      cursor: pointer;
    }

    /* Table */
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    th, td {
      padding: 12px 16px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background: #002b7f;
      color: white;
      text-transform: uppercase;
      font-size: 14px;
    }

    td {
      font-size: 15px;
      color: #333;
    }

    tr:last-child td {
      border-bottom: none;
    }

    .no-data {
      text-align: center;
      padding: 20px;
      color: #888;
      font-style: italic;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 180px;
      }
      .topbar {
        left: 180px;
      }
      .main-content {
        margin-left: 190px;
        margin-top: 80px;
        padding: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <img src="{{ asset('images/logo.png') }}" alt="University Logo">
    <h2>FYP Tracker</h2>
    <a href="{{route('student')}}">Create Group</a>
    <a href="{{ route('project') }}">Create Project</a>
    <a href="{{ route('meeting') }}">Meeting Schedule</a>
    <a href="{{route('notification')}}">Notifications</a>
  </div>

  <!-- ✅ Fixed topbar aligned with sidebar -->
  <div class="topbar">Student Dashboard</div>

  <div class="main-content">
    <h1>Meeting Schedule</h1>

    <!-- Toggle Section -->
    <div class="toggle-group">
      <label><input type="radio" name="type" checked> Current</label>
      <label><input type="radio" name="type"> Old</label>
    </div>

    <div class="toggle-group">
      <label><input type="radio" name="filter" checked> All</label>
      <label><input type="radio" name="filter"> Committee</label>
      <label><input type="radio" name="filter"> Supervisor</label>
    </div>

    <!-- Meeting Table -->
    <table>
      <thead>
        <tr>
          <th>Meeting Agenda</th>
          <th>Date</th>
          <th>Start Time</th>
          <th>End Time</th>
        </tr>
      </thead>
      <tbody>
        @forelse($meetings ?? [] as $meeting)
          <tr>
            <td>{{ $meeting->agenda }}</td>
            <td>{{ $meeting->date }}</td>
            <td>{{ $meeting->start_time }}</td>
            <td>{{ $meeting->end_time }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="no-data">No meetings scheduled yet.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</body>
</html>
