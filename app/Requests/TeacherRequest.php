<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'abbreviation' => ['required', 'string'],
            'gender_id' => ['required', 'exists:genders,id'],
            'entry' => ['required', 'date'],
            'exit' => ['nullable', 'date'],
            'job_title_id' => ['required', 'exists:job_titles,id'],
            'salary_grade_id' => ['required', 'exists:salary_grades,id'],
            'status_type_id' => ['required', 'exists:status_types,id'],
            'status_since' => ['required', 'date'],
            'last_assessment_at' => ['nullable', 'date'],
            'last_assessment_type_id' => ['nullable', 'exists:assessment_types,id'],
            'assessment_obstacle_id' => ['nullable', 'exists:assessment_obstacles,id'],
            'assessment_obstacle_ends_at' => ['nullable', 'date'],
            'expected_assessment_deadline' => ['required', 'date'],
            'fixed_assessment_deadline' => ['nullable', 'date'],
            'next_assessment_type_id' => ['required', 'exists:assessment_types,id'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'exit' => $this->exit === "" ? null : $this->exit,
            'last_assessment_at' => $this->last_assessment_at === "" ? null : $this->last_assessment_at,
            'last_assessment_type_id' => (int) $this->last_assessment_type_id === 0 ? null : (int)$this->last_assessment_type_id,
            'assessment_obstacle_id' => (int) $this->assessment_obstacle_id === 0 ? null : (int)$this->assessment_obstacle_id,
            'assessment_obstacle_ends_at' => $this->assessment_obstacle_ends_at === "" ? null : $this->assessment_obstacle_ends_at,
            'expected_assessment_deadline' => $this->expected_assessment_deadline === "" ? null : $this->expected_assessment_deadline,
            'fixed_assessment_deadline' => $this->fixed_assessment_deadline === "" ? null : $this->fixed_assessment_deadline,
        ]);
    }

}
