<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Project Selection Form - FYP Tracker</title>
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
      background: #f5f6fa;
      overflow: hidden;
    }

    /* Sidebar */
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: 15%;
      height: 100%;
      background: linear-gradient(to bottom, #1e3c72, #1b2b47ff);
      padding: 20px;
      text-align: center;
      color: white;
      transition: transform 0.4s ease;
      z-index: 1000;
    }

    .sidebar img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
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
      background: linear-gradient(to bottom, #1e3c72, #1b2b47ff);
      color: white;
      padding: 15px 20px;
      font-size: 22px;
      font-weight: bold;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 999;
    }

    /* Hamburger button */
    .menu-toggle {
      position: absolute;
      left: 20px;
      font-size: 26px;
      cursor: pointer;
      display: none;
    }

    /* Main Content Area */
    .right {
      margin-left: 15%;
      width: 85%;
      display: flex;
      flex-direction: column;
      height: 100vh;
    }

    .form-container {
      padding: 100px 60px 30px 60px;
      overflow-y: auto;
      height: calc(100vh - 60px);
    }

    .form-container h2 {
      font-size: 28px;
      text-align: center;
      margin-bottom: 20px;
      color: #153e90;
    }

    .rules-box {
      background: #e8e9ef;
      border-radius: 12px;
      padding: 15px 25px;
      margin-bottom: 25px;
      font-size: 15px;
      color: #333;
    }

    .rules-box ol {
      margin-left: 25px;
      margin-top: 10px;
    }

    .toggle-buttons {
      display: flex;
      justify-content: center;
      gap: 40px;
      margin-bottom: 25px;
    }

    .toggle-buttons label {
      font-size: 18px;
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      color: #333;
    }

    .toggle-buttons input[type="radio"] {
      transform: scale(1.3);
      accent-color: #153e90;
    }

    select {
      width: 50%;
      padding: 10px;
      margin: 15px auto;
      display: block;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
      outline: none;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th, td {
      border: 1px solid #ccc;
      padding: 10px 15px;
      text-align: center;
    }

    th {
      background: #153e90;
      color: white;
      font-weight: 500;
    }

    td input, td select {
      width: 90%;
      padding: 6px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 15px;
      outline: none;
    }

    .submit-btn {
      margin-top: 25px;
      display: block;
      width: 20%;
      padding: 12px;
      font-size: 18px;
      border: none;
      border-radius: 8px;
      background: #153e90;
      color: white;
      cursor: pointer;
      transition: 0.3s;
      margin-left: auto;
      margin-right: auto;
    }

    .submit-btn:hover {
      background: #102d68;
    }

    /* Responsive Sidebar for Mobile */
    @media (max-width: 768px) {
      .sidebar {
        width: 70%;
        transform: translateX(-100%);
      }

      .sidebar.active {
        transform: translateX(0);
      }

      .menu-toggle {
        display: block;
      }

      .topbar {
        left: 0;
        width: 100%;
        justify-content: center;
      }

      .right {
        margin-left: 0;
        width: 100%;
      }

      .form-container {
        padding: 100px 30px;
      }

      .submit-btn {
        width: 50%;
      }
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <img src="{{ asset('images/logo.png') }}" alt="University Logo" />
    <h3>FYP Tracker</h3>
    <a href="{{route('student')}}">Create Group</a>
    <a href="{{ route('project') }}">Create Project</a>
    <a href="{{route('meeting')}}">Meeting Schedule</a>
    <a href="#">Notifications</a>
  </div>

  <!-- Right Section -->
  <div class="right">
    <div class="topbar">
      <span class="menu-toggle" id="menuToggle">&#9776;</span>
      Students Dashboard
    </div>

    <div class="form-container">
      <h2>Project Selection Form</h2>

      <div class="rules-box">
        <strong>Rules for creating Groups:</strong>
        <ol>
          <li>Each group will consist of 5 members.</li>
          <li>Group members will be differentiated on the basis of Technology.</li>
        </ol>
      </div>

      <div class="toggle-buttons">
        <label>
          <input type="radio" name="project_type" value="new"
            onclick="window.location='{{route('student.new_project')}}'"> New Projects
        </label>
        <label><input type="radio" name="project_type" value="select" checked> Select Projects</label>
      </div>

      <select id="projectSelect">
        <option value="">--Select a project--</option>
      </select>

      <h3 style="margin-top:25px;">Group Members</h3>

      <table>
        <thead>
          <tr>
            <th>S#</th>
            <th>NUN#</th>
            <th>Name</th>
            <th>CGPA</th>
            <th>Technology</th>
          </tr>
        </thead>
        <tbody id="studentTableBody">
          @for ($i = 0; $i < 5; $i++)
            <tr>
              <td>{{ $i + 1 }}</td>
              <td><input type="text" name="nun[]" placeholder="Enter NUN#"></td>
              <td><input type="text" name="name[]" placeholder="Enter Name"></td>
              <td><input type="text" name="cgpa[]" placeholder="Enter CGPA"></td>
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

  <script>
    // Load projects dynamically
    fetch('/api/projects')
      .then(res => res.json())
      .then(projects => {
        const select = document.getElementById('projectSelect');
        projects.forEach(p => {
          const option = document.createElement('option');
          option.value = p.id;
          option.textContent = p.title;
          select.appendChild(option);
        });
      })
      .catch(err => console.error('Error loading projects:', err));

    // Sidebar toggle
    document.getElementById('menuToggle').addEventListener('click', () => {
      document.getElementById('sidebar').classList.toggle('active');
    });
  </script>
</body>
</html>
