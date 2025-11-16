<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TugasWeek7 extends Controller
{
    //
    function login() {
        $this->seedDummyData();
        return view('pages.login');
    }

    function register() {
        return view('pages.register');
    }

    function viewManagerProjects(Request $req) {
        $projects = $this->getProjectsByManager($req);
        // $req->session()->forget('projects');
        if ($req->session()->has('user_login')) {
            return view('pages.manager_projects', ['projects' => $projects]);
        } else {
            return redirect()->route('login');
        }
    }

    function createManagerProjects(Request $req) {
        $employees = $this->getEmployees($req);
        if ($req->session()->has('user_login')) {
            return view('pages.create_projects', ['employees' => $employees]);
        } else {
            return redirect()->route('login');
        }
    }

    function viewEmployeeProjects(Request $req) {
        if ($req->session()->has('user_login')) {
            $user_email = $req->session()->get('user_login')['email'];
            $employee_projects = $this->getEmployeeProjects($req, $user_email);
            return view('pages.employee_projects', ['projects' => $employee_projects]);
        } else {
            return redirect()->route('login');
        }
    }

    function viewManagerProjectDetail(Request $req, $project_id) {
        if ($req->session()->has('user_login')) {

            $curr_project = null;
            $projects = $this->getProjects($req);
            foreach($projects as $project) {
                if ($project['id'] == $project_id) {
                    $curr_project = $project;
                    break;
                }
            }

            return view('pages.manager_project_detail', ['project' => $curr_project]);
        } else {
            return redirect()->route('login');
        }
    }

    function viewEmployeeProjectDetail(Request $req, $project_id) {
        if ($req->session()->has('user_login')) {

            $curr_project = null;
            $projects = $this->getProjects($req);
            foreach($projects as $project) {
                if ($project['id'] == $project_id) {
                    $curr_project = $project;
                    break;
                }
            }

            return view('pages.employee_project_detail', ['project' => $curr_project]);
        } else {
            return redirect()->route('login');
        }
    }

    function viewManagerCreateTodo(Request $req, $project_id) {
         if ($req->session()->has('user_login')) {

            $curr_project = null;
            $projects = $this->getProjects($req);
            foreach($projects as $project) {
                if ($project['id'] == $project_id) {
                    $curr_project = $project;
                    break;
                }
            }

            $employees = $this->getEmployeesByProjectID($req, $curr_project);

            return view('pages.create_todo', ['project' => $curr_project, 'employees' => $employees]);
        } else {
            return redirect()->route('login');
        }
    }

    function getEmployeesByProjectID(Request $req, $project) {
        $employees = $this->getEmployees($req);
        $filtered_employees = [];
        foreach($employees as $employee) {
            if (in_array($employee['email'], $project['email_members'])) {
                $filtered_employees[] = $employee;
            }
        }
        return $filtered_employees;
    }

    function getEmployeeProjects(Request $req, $user_email) {
        $employee_projects = [];
        $projects = $req->session()->get('projects');
        foreach($projects as $project) {
            if (in_array($user_email, $project['email_members'])) {
                $employee_projects[] = $project;
            }
        }

        return $employee_projects;
    }

    function seedDummyData() {
        if (session()->has('projects') && session()->has('users')) {
            return;
        }

        $users = [
            [
                "name" => "Zinx",
                "email" => "zinx@gmail.com",
                "password" => "123",
                "role" => "Manager"
            ],
            [
                "name" => "Han",
                "email" => "han@gmail.com",
                "password" => "123",
                "role" => "Employee"
            ],
            [
                "name" => "Bri",
                "email" => "bri@gmail.com",
                "password" => "123",
                "role" => "Employee"
            ],
            [
                "name" => "Matt",
                "email" => "matt@gmail.com",
                "password" => "123",
                "role" => "Manager"
            ],
        ];

        $projects = [
            [
                "id" => 1,
                "name" => "Praktikum BWP - Ganjil 2025/2026",
                'manager' => 'Zinx',
                'manager_email' => 'zinx@gmail.com',
                "status" => "Todo",
                "start_date" => "2025-09-01",
                "end_date" => "2026-01-15",
                "email_members" => ["han@gmail.com", "bri@gmail.com"],
                "description" => "Praktikum sangat seru, dijalankan selama satu semester",
                "todolists" => [
                    [
                        "todolist_name" => "Membuat tutor minggu 3",
                        "status" => "In Progress",
                        "assigned_to" => "Han",
                        "assigned_to_email" => "han@gmail.com",
                        "start_date" => "2025-09-15",
                        "deadline" => "2025-09-20"
                    ],
                    [
                        "todolist_name" => "Membuat soal TA",
                        "status" => "Todo",
                        "assigned_to" => "Bri",
                        "assigned_to_email" => "bri@gmail.com",
                        "start_date" => "2025-09-15",
                        "deadline" => "2025-09-20"
                    ],
                ]
            ],
            [
                "id" => 2,
                "name" => "Proyek ADBO",
                'manager' => 'Matt',
                'manager_email' => 'matt@gmail.com',
                "status" => "In Progress",
                "start_date" => "2025-09-01",
                "end_date" => "2026-01-15",
                "email_members" => ["han@gmail.com"],
                "description" => "Praktikum sangat seru, dijalankan selama satu semester",
                "todolists" => [
                    [
                        "todolist_name" => "Membuat tutor minggu 5",
                        "status" => "In Progress",
                        "assigned_to" => "Han",
                        "assigned_to_email" => "han@gmail.com",
                        "start_date" => "2025-09-15",
                        "deadline" => "2025-09-20"
                    ],
                    [
                        "todolist_name" => "Membuat soal Tes Awal",
                        "status" => "Todo",
                        "assigned_to" => "Han",
                        "assigned_to_email" => "han@gmail.com",
                        "start_date" => "2025-09-15",
                        "deadline" => "2025-09-20"
                    ],
                ]
            ],
            [
                "id" => 3,
                "name" => "Proyek Visual Programming",
                'manager' => 'Zinx',
                'manager_email' => 'zinx@gmail.com',
                "status" => "Complete",
                "start_date" => "2025-09-01",
                "end_date" => "2026-01-15",
                "email_members" => ["bri@gmail.com"],
                "description" => "Praktikum sangat seru, dijalankan selama satu semester",
                "todolists" => [
                    [
                        "todolist_name" => "Membuat tutor minggu 2",
                        "status" => "In Progress",
                        "assigned_to" => "Bri",
                        "assigned_to_email" => "bri@gmail.com",
                        "start_date" => "2025-09-15",
                        "deadline" => "2025-09-20"
                    ],
                    [
                        "todolist_name" => "Membuat file tutor",
                        "status" => "Todo",
                        "assigned_to" => "Bri",
                        "assigned_to_email" => "bri@gmail.com",
                        "start_date" => "2025-09-15",
                        "deadline" => "2025-09-20"
                    ],
                ]
            ],
        ];

        session()->put('users', $users);
        session()->put('projects', $projects);
    }

    function getUsers(Request $req) {
        $session = $req->session();
        if (!$session->has('users')) {
            $session->put('users', []);

            return [];
        }

        $users = $session->get('users');
        return $users;
    }

    function getEmployees(Request $req) {
        $session = $req->session();
        if (!$session->has('users')) {
            $session->put('users', []);

            return [];
        }

        $users = $session->get('users');
        $employees = [];

        foreach($users as $user) {
            if ($user['role'] == 'Employee') {
                $employees[] = $user;
            }
        }

        return $employees;
    }

    function getProjectsByManager(Request $req) {
        $projects = $this->getProjects($req);
        $manager_email = $req->session()->get('user_login')['email'];

        $filtered_projects = [];
        foreach($projects as $project) {
            if ($project['manager_email'] == $manager_email) {
                $filtered_projects[] = $project;
            }
        }

        return $filtered_projects;
    }

    function getProjects(Request $req) {
        $session = $req->session();
        if (!$session->has('projects')) {
            $session->put('projects', []);

            return [];
        }

        $projects = $session->get('projects');
        return $projects;
    }

    function isRegisteredEmail(Request $req, $email) {
        $users = $this->getUsers($req);

        foreach($users as $user) {
            if ($user['email'] == $email) {
                return true;
            }
        }

        return false;
    }

    function doLogout(Request $req) {
        $req->session()->forget('user_login');
        return redirect()->route('login');
    }

    function doLogin(Request $req) {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ],
        [
            'email.required' => 'The email field is required.',
            'email.email' => 'Invalid email',
            'password.required' => 'The password field is required.',
        ]);

        $email = $req->input('email');
        $password = $req->input('password');

        $users = $this->getUsers($req);
        $user_login = null;

        foreach($users as $user) {
            if ($user['email'] == $email) {
                $user_login = $user;
                break;
            }
        }

        if ($user_login != null) {

            if ($user_login['password'] == $password) {

                $req->session()->put('user_login', $user_login);

                if ($user_login['role'] == 'Manager') {
                    return redirect()->route('manager-projects');
                }

                if ($user_login['role'] == 'Employee') {
                    return redirect()->route('employee-projects');
                }

            } else {
                return redirect()->route('login')->with('err', 'Wrong password');
            }
        }

        return redirect()->route('login')->with('err', 'Email not registered');

    }

    function createProject(Request $req) {
        $req->validate([
            'project_title' => 'required|string',
            'project_description' => 'required|string',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'members' => 'required|array|min:1'
        ],
        [
            'project_title.required' => 'Project title is required',
            'project_description.required' => 'Project description is required',
            'start_date.required' => 'Start date is required',
            'end_date.required' => 'End date is required',
            'members.required' => 'Select at least 1 employee!',
            'members.min' => 'Select at least 1 employee!',
            'start_date.date' => 'Invalid date format',
            'start_date.before_or_equal' => 'Start date must be before end date',
            'end_date.date' => 'Invalid date format',
            'end_date.after_or_equal' => 'The end date must be after the start date.',
        ]);


        $project_title = $req->input('project_title');
        $project_description = $req->input('project_description');
        $start_date = date('Y-m-d', strtotime($req->input('start_date')));
        $end_date = date('Y-m-d', strtotime($req->input('end_date')));
        $members = $req->input('members');
        $manager = $req->session()->get('user_login')['name'];
        $manager_email = $req->session()->get('user_login')['email'];

        $projects = $this->getProjects($req);

        $new_project = [
            "id" => $projects ? end($projects)['id'] + 1 : 1,
            "name" => $project_title,
            'manager' => $manager,
            'manager_email' => $manager_email,
            "status" => "Todo",
            "start_date" => $start_date,
            "end_date" => $end_date,
            "email_members" => $members,
            "description" => $project_description,
            "todolists" => []
        ];

        $projects[] = $new_project;

        $req->session()->put('projects', $projects);

        return redirect()->route('manager-projects');

    }

    function updateProjectStatus(Request $req, $project_id) {
        $projects = $this->getProjectsByManager($req);
        $status = $req->input('status');

        foreach($projects as &$project) {
            if ($project['id'] == $project_id) {
                $project['status'] = $status;
                break;
            }
        }
        unset($project);

        $req->session()->put('projects', $projects);

        return redirect()->route('manager-project-detail',  ['id' => $project_id]);
    }

    function findUsernameByEmail(Request $req, $email) {
        $users = $this->getUsers($req);
        foreach($users as $user) {
            if ($user['email'] == $email) {
                return $user['name'];
            }
        }

        return 'Not Found';
    }

   function updateEmployeeToDo(Request $req, $project_id, $todolist_id) {
        $projects = $this->getProjects($req);
        $status = $req->input('status');

        foreach ($projects as &$project) {
            if ($project['id'] == $project_id) {
                foreach ($project['todolists'] as $j => &$todolist) {
                    if ($j == $todolist_id) {
                        $todolist['status'] = $status;
                    }
                }
                unset($todolist);
                break;
            }
        }
        unset($project);

        $req->session()->put('projects', $projects);

        return redirect()->route('employee-project-detail', ['id' => $project_id]);
    }

   function createToDo(Request $req, $project_id) {
        $req->validate([
            "todolist_name" => 'required|string',
            "assigned_to" => 'required|string',
            'end_date' => 'required|date',
            'start_date' => 'required|date|before_or_equal:deadline',
            'deadline' => 'required|date|before_or_equal:end_date',
            ],
            [
                'todolist_name.required' => 'Todolist name is required',
                'assigned_to.required' => 'Assigned To is required',
                'start_date.required' => 'Start date is required',
                'deadline.required' => 'Deadline is required',
                'start_date.before_or_equal' => 'Start date must be before or same as deadline',
                'deadline.before_or_equal' => 'Deadline must be before or same as end date',
            ]);

        $todolist_name = $req->input('todolist_name');
        $assigned_to_email = $req->input('assigned_to');
        $assigned_to = $this->findUsernameByEmail($req, $assigned_to_email);
        $start_date = $req->input('start_date');
        $deadline = $req->input('deadline');

        $projects = $req->session()->get('projects');

        $new_todolist = [
            "todolist_name" => $todolist_name,
            "status" => "Todo",
            "assigned_to" => $assigned_to,
            "assigned_to_email" => $assigned_to_email,
            "start_date" => $start_date,
            "deadline" => $deadline
        ];

        foreach($projects as &$project) {
            if ($project['id'] == $project_id) {
                $project['todolists'][] = $new_todolist;
                break;
            }
        }
        unset($project);

        $req->session()->put('projects', $projects);

        return redirect()->route('manager-project-detail', ['id' => $project_id]);
    }

    function deleteProject(Request $req, $id) {
        $projects = $this->getProjects($req);

        $index = null;
        foreach($projects as $i => $project) {
            if ($project['id'] == $id) {
                $index = $i;
                break;
            }
        }

        if ($index != null) {
            array_splice($projects, $index, 1);

            $req->session()->put('projects', $projects);

            return redirect()->route('manager-projects');
        } else {
            abort(403, 'Project not found');
        }
    }

    function doRegister(Request $req) {
        $req->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'confirm_password' => 'required|string',
            'role' => 'required|string'
        ],
        [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Invalid email',
            'password.required' => 'The password field is required.',
            'confirm_password.required' => 'The confirm password field is required.',
            'role.required' => 'The role field is required.',
        ]);

        $name = $req->input('name');
        $email = $req->input('email');
        $password = $req->input('password');
        $confirm_password = $req->input('confirm_password');
        $role = $req->input('role');

        if ($password != $confirm_password) {
            return redirect()->route('register')->with('err', 'Password and Confrim Password must be equals');
        }

        if ($this->isRegisteredEmail($req, $email)) {
            return redirect()->route('register')->with('err', 'Email is already registered');
        }

        $users = $this->getUsers($req);

        $new_user = [
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "role" => $role
        ];

        $users[] = $new_user;
        $req->session()->put('users', $users);

        return redirect()->route('register')->with('success', 'Akun registered successfully');
    }

}
