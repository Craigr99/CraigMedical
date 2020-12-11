<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function testUserNeedsToBeLoggedInToSeeDashboard()
    {
        $response = $this->get('/home')->assertRedirect('/login');
    }

    // Admin access admin dashboard
    public function testAdminWithAdminRoleCanAccessAdminDashboard()
    {
        $user = User::factory()->create();
        $user->roles()->attach(Role::where('name', 'admin')->first());

        $this->actingAs($user);
        $response = $this->get('/admin/home')->assertOk();
    }

    // Doctor access doctor dashboard
    public function testDoctorWithDoctorRoleCanAccessDoctorDashboard()
    {
        $user = User::factory()->create();
        $user->roles()->attach(Role::where('name', 'doctor')->first());

        $this->actingAs($user);
        $response = $this->get('/doctor/home')->assertOk();
    }

    // Patient access Patient dashboard
    public function testPatientWithPatientRoleCanAccessPatientDashboard()
    {
        $user = User::factory()->create();
        $user->roles()->attach(Role::where('name', 'patient')->first());

        $this->actingAs($user);
        $response = $this->get('/patient/home')->assertOk();
    }

    // Doctors and patients cannot access admin dashboard
    public function testDoctorsAndPatientsCannotAccessAdminDashboard()
    {
        $doctor = User::factory()->create();
        $patient = User::factory()->create();
        $doctor->roles()->attach(Role::where('name', 'doctor')->first());
        $patient->roles()->attach(Role::where('name', 'patient')->first());

        $this->actingAs($doctor);
        $response = $this->get('/admin/home')->assertRedirect('/home');
        $this->actingAs($patient);
        $response = $this->get('/admin/home')->assertRedirect('/home');
    }

}
