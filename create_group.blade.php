<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Group Creation Form - FYP Tracker</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { height: 100vh; display: flex; font-family: Arial, sans-serif; }
    .sidebar {
      width: 15%; background: linear-gradient(to bottom, #1e3c72, #1b2b47ff);
      padding: 20px; text-align: center; color: white;
    }
    .sidebar img { width: 100px; height: 100px; border-radius: 50%; margin-bottom: 20px; }
    .sidebar a { display: flex; align-items: center; justify-content: center; margin-top: 40px;
                 text-decoration: none; font-size: 18px; color: #fff; transition: 0.3s; }
    .sidebar a:hover { color: #ffd700; text-decoration: underline; }
    .right { width: 85%; display: flex; flex-direction: column; }
    .topbar { background: linear-gradient(to bottom, #1e3c72, #1b2b47ff); color: white; padding: 15px;
              font-size: 22px; font-weight: bold; text-align: center; }
    .main { text-align: center; margin-top: 30px; }
    .content { width: 90%; margin: 20px auto; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    table, th, td { border: 1px solid #ccc; }
    th, td { padding: 12px; text-align: center; }
    th { background: #1e3c72; color: white; }
    input, select { width: 90%; padding: 8px; border: 1px solid #ccc; border-radius: 5px; }
    .btn-container { display: flex; justify-content: center; gap: 20px; }
    .submit-btn { margin-top: 20px; padding: 10px 25px; background: #1e3c72; color: white;
                  border: none; border-radius: 5px; cursor: pointer; transition: 0.3s; }
    .submit-btn:hover { background: #162b4a; }
    @media (max-width: 768px) {
      body { flex-direction: column; }
      .sidebar { width: 100%; height: auto; }
      .right { width: 100%; }
      table, th, td { font-size: 14px; }
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <img src="{{ asset('images/logo.png') }}" alt="logo">
    <h3>FYP Tracker</h3>
    <a href="#">Create Group</a>
    <a href="{{ route('project') }}">Create Project</a>
    <a href="{{ route('meeting') }}">Meeting Schedule</a>
  </div>

  <!-- Right Side -->
  <div class="right">
    <div class="topbar">Student Dashboard</div>
    <div class="main"><h2>Group Creation Form</h2></div>  
    <div class="content">
      <form id="groupForm" action="{{ url('/api/group/create') }}" method="POST">
        @csrf
        <h3>Group Members</h3>
        <table id="groupTable">
          <thead>
            <tr>
              <th>No.</th>
              <th>Registration No</th>
              <th>Name</th>
              <th>Technology</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="row-number">1</td>
              <td><input type="text" name="registration_no[]" class="reg-input" placeholder="Enter Reg. No"></td>
              <td><input type="text" name="name[]" class="name-input" placeholder="Auto-filled or Enter Name"></td>
              <td>
                <select name="technology[]">
                  <option value="Web">Web</option>
                  <option value="Flutter">Flutter</option>
                  <option value="React Native">React Native</option>
                  <option value="Android">Android</option>
                  <option value="iOS">iOS</option>
                </select>
              </td>
              <td><button type="button" class="remove-row-btn">Remove</button></td>
            </tr>
          </tbody>
        </table>

        <div class="btn-container">
          <button type="submit" class="submit-btn">Create Group</button>
          <button type="button" class="submit-btn" id="addToGroupBtn">Add Member</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const groupTable = document.getElementById('groupTable').getElementsByTagName('tbody')[0];
    const addBtn = document.getElementById('addToGroupBtn');
    const maxMembers = 5;

    // Update row numbers
    function updateRowNumbers() {
      groupTable.querySelectorAll('tr').forEach((row, index) => {
        row.querySelector('.row-number').textContent = index + 1;
      });
    }

    // Fetch student name by registration number
    function attachRegNoListener(input) {
      input.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
          e.preventDefault();
          const regNo = this.value.trim();
          if (!regNo) return;

          fetch(`/api/students/fetch?registration_no=${encodeURIComponent(regNo)}`, {
            headers: { 'Accept': 'application/json' }
          })
          .then(response => {
            if (!response.ok) return response.json().then(err => Promise.reject(err));
            return response.json();
          })
          .then(data => {
            const nameField = this.closest('tr').querySelector('.name-input');
            if (data.status && data.data && data.data.user && data.data.user.name) {
              nameField.value = data.data.user.name;
              Swal.fire({
                icon: 'success',
                title: 'Student Found',
                text: `Student name: ${data.data.user.name}`,
                confirmButtonColor: '#1e3c72'
              });
            } else {
              nameField.value = 'Not Found';
              Swal.fire({
                icon: 'error',
                title: 'Invalid Registration Number',
                text: `The registration number "${regNo}" is invalid or not found.`,
                confirmButtonColor: '#1e3c72'
              });
            }
          })
          .catch(err => {
            console.error('Error:', err);
            Swal.fire({
              icon: 'warning',
              title: 'Server Error',
              text: err.message || 'An error occurred while fetching student details.',
              confirmButtonColor: '#1e3c72'
            });
          });
        }
      });
    }

    // Remove row
    function attachRemoveListener(btn) {
      btn.addEventListener('click', function() {
        this.closest('tr').remove();
        updateRowNumbers();
      });
    }

    // Attach initial row listeners
    document.querySelectorAll('.reg-input').forEach(input => attachRegNoListener(input));
    document.querySelectorAll('.remove-row-btn').forEach(btn => attachRemoveListener(btn));

    // Add Member button
    addBtn.addEventListener('click', function() {
      const currentRows = groupTable.querySelectorAll('tr').length;
      if (currentRows >= maxMembers) {
        Swal.fire({
          icon: 'warning',
          title: 'Maximum Members Reached',
          text: `You can add up to ${maxMembers} members only.`,
          confirmButtonColor: '#1e3c72'
        });
        return;
      }

      const newRow = document.createElement('tr');
      newRow.innerHTML = `
        <td class="row-number">${currentRows + 1}</td>
        <td><input type="text" name="registration_no[]" class="reg-input" placeholder="Enter Reg. No"></td>
        <td><input type="text" name="name[]" class="name-input" placeholder="Auto-filled or Enter Name"></td>
        <td>
          <select name="technology[]">
            <option value="Web">Web</option>
            <option value="Flutter">Flutter</option>
            <option value="React Native">React Native</option>
            <option value="Android">Android</option>
            <option value="iOS">iOS</option>
          </select>
        </td>
        <td><button type="button" class="remove-row-btn">Remove</button></td>
      `;
      groupTable.appendChild(newRow);

      attachRegNoListener(newRow.querySelector('.reg-input'));
      attachRemoveListener(newRow.querySelector('.remove-row-btn'));
    });
  </script>
</body>
</html>
