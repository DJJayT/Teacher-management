<form action="{{ $route }}" method="post" id="teacherForm">
    @csrf
    <div class="row">
        <div class="mb-2 col-xl-4 col-md-6 col-sm-12">
            <label for="firstname" class="form-label">{{ __('Firstname') }} (*)</label>
            <input type="text" class="form-control" name="firstname" id="firstname"
                   @if(isset($teacher))
                       value="{{ $teacher->firstname }}"
                   @endif
                   required>
        </div>
        <div class="mb-2 col-xl-4 col-md-6 col-sm-12">
            <label for="lastname" class="form-label">{{ __('Lastname') }} (*)</label>
            <input type="text" class="form-control" name="lastname" id="lastname"
                   @if(isset($teacher))
                       value="{{ $teacher->lastname }}"
                   @endif
                   required>
        </div>
        <div class="mb-2 col-xl-4 col-md-6 col-sm-12">
            <label for="abbreviation" class="form-label">{{ __('Abbreviation') }} (*)</label>
            <input type="text" class="form-control" name="abbreviation" id="abbreviation"
                   @if(isset($teacher))
                       value="{{ $teacher->abbreviation }}"
                   @endif
                   required>
        </div>
    </div>
    <div class="row">
        <div class="mb-2 col-xl-4 col-md-6 col-sm-12">
            <label for="gender">{{ __('Gender') }} (*)</label>
            <select class="form-select" name="gender_id" id="gender">
                @if(!isset($teacher))
                    <option value="0" selected>{{ __('Select the gender') }}</option>
                @endif
                @foreach($genders as $gender)
                    <option
                        @if(isset($teacher) && $teacher->gender_id == $gender->id)
                            selected
                        @endif
                        value="{{ $gender->id }}">{{ $gender->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2 col-xl-4 col-md-6 col-sm-12">
            <label for="entry">{{ __('Entry') }} (*)</label>
            <input type="date" class="form-control" name="entry" id="entry"
                   @if(isset($teacher))
                       value="{{ $teacher->entry->format('Y-m-d') }}"
                   @endif
                   required>
        </div>
        <div class="mb-2 col-xl-4 col-md-6 col-sm-12">
            <label for="exit">{{ __('Exit') }}</label>
            <input type="date" class="form-control" name="exit" id="exit"
                   @if(isset($teacher) && $teacher->exit != null)
                       value="{{ $teacher->exit->format('Y-m-d') }}"
                @endif>
        </div>
    </div>
    <div class="row">
        <div class="mb-2 col-xl-4 col-md-6 col-sm-12">
            <label for="jobTitle">{{ __('Job title') }} (*)</label>
            <select class="form-select" name="job_title_id" id="jobTitle" required>
                @if(!isset($teacher))
                    <option value="0" selected>{{ __('Select the job title') }}</option>
                @endif
                @foreach($jobTitles as $jobTitle)
                    <option
                        @if(isset($teacher) && $teacher->job_title_id == $jobTitle->id)
                            selected
                        @endif
                        value="{{ $jobTitle->id }}">{{ $jobTitle->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2 col-xl-4 col-md-6 col-sm-12">
            <label for="salaryGrade">{{ __('Salary grade') }} (*)</label>
            <select class="form-select" name="salary_grade_id" id="salaryGrade" required>
                @if(!isset($teacher))
                    <option value="0" selected>{{ __('Select the salary grade') }}</option>
                @endif
                @foreach($salaryGrades as $salaryGrade)
                    <option
                        @if(isset($teacher) && $teacher->salary_grade_id == $salaryGrade->id)
                            selected
                        @endif
                        value="{{ $salaryGrade->id }}">{{ $salaryGrade->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2 col-xl-4 col-md-6 col-sm-12">
            <label for="status">{{ __('Status') }} (*)</label>
            <select class="form-select" name="status_type_id" id="status">
                @if(!isset($teacher))
                    <option value="0" selected>{{ __('Select the status') }}</option>
                @endif
                @foreach($statuses as $status)
                    <option
                        @if(isset($teacher) && $teacher->status_type_id == $status->id)
                            selected
                        @endif
                        value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-2 col-xl-4 col-md-6 col-sm-12">
            <label for="statusSince">{{ __('Status since') }} (*)</label>
            <input type="date" class="form-control" name="status_since" id="statusSince"
                   @if(isset($teacher))
                       value="{{ $teacher->status_since->format('Y-m-d') }}"
                   @endif required>
        </div>
        <div class="mb-2 col-xl-4 col-md-6 col-sm-12">
            <label for="lastAssessmentDate">{{ __('Last assessment date') }}</label>
            <input type="date" class="form-control" name="last_assessment_at" id="lastAssessmentDate"
                   @if(isset($teacher) && $teacher->last_assessment_at != null)
                       value="{{ $teacher->last_assessment_at->format('Y-m-d') }}"
                @endif>
        </div>
        <div class="mb-2 col-xl-4 col-md-6 col-sm-12">
            <label for="lastAssessmentTypeId">{{ __('Last assessment type') }}</label>
            <select class="form-select" name="last_assessment_type_id" id="lastAssessmentTypeId" required>
                @if(!isset($teacher))
                    <option value="0" selected>{{ __('Select the last assessment type') }}</option>
                @endif
                @foreach($assessmentTypes as $assessmentType)
                    <option
                        @if(isset($teacher) && $teacher->last_assessment_type_id == $assessmentType->id)
                            selected
                        @endif
                        value="{{ $assessmentType->id }}">{{ $assessmentType->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-2 col-xl-4 col-md-6 col-sm-12">
            <label for="assessmentObstacle">{{ __('Assessment obstacle') }}</label>
            <select class="form-select" name="assessment_obstacle_id" id="assessmentObstacle">
                @if(!isset($teacher) || $teacher->assessment_obstacle_id == null)
                    <option value="0" selected>{{ __('Select the assessment obstacle') }}</option>
                @endif
                @foreach($assessmentObstacles as $assessmentObstacle)
                    <option
                    @if(isset($teacher) && $teacher->assessment_obstacle_id == $assessmentObstacle->id)
                            selected
                        @endif
                        value="{{ $assessmentObstacle->id }}">{{ $assessmentObstacle->reason }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2 col-xl-4 col-md-6 col-sm-12">
            <label for="assessmentObstacleEndsAt">{{ __('Assessment obstacle ends at') }}</label>
            <input type="date" class="form-control" name="assessment_obstacle_ends_at" id="assessmentObstacleEndsAt"
                   @if(isset($teacher) && $teacher->assessment_obstacle_ends_at != null)
                       value="{{ $teacher->assessment_obstacle_ends_at->format('Y-m-d') }}"
                @endif>
        </div>
        <div class="mb-2 col-xl-4 col-md-6 col-sm-12">
            <label for="expectedAssessmentDeadline">{{ __('Expected assessment deadline') }} (*)</label>
            <input type="date" class="form-control" name="expected_assessment_deadline" id="expectedAssessmentDeadline"
                   @if(isset($teacher) && $teacher->expected_assessment_deadline != null)
                       value="{{ $teacher->expected_assessment_deadline->format('Y-m-d') }}"
                @endif>
        </div>
    </div>
    <div class="row">
        <div class="mb-2 col-xl-4 col-md-6 col-sm-12">
            <label for="fixedAssessmentDeadline">{{ __('Fixed assessment deadline') }}</label>
            <input type="date" class="form-control" name="fixed_assessment_deadline" id="fixedAssessmentDeadline"
                   @if(isset($teacher) && $teacher->fixed_assessment_deadline != null)
                       value="{{ $teacher->fixed_assessment_deadline->format('Y-m-d') }}"
                @endif>
        </div>
        <div class="mb-2 col-xl-4 col-md-6 col-sm-12">
            <label for="nextAssessmentType">{{ __('Next assessment type') }} (*)</label>
            <select class="form-select" name="next_assessment_type_id" id="nextAssessmentTypeId">
                @if(!isset($teacher))
                    <option value="0" selected>{{ __('Select the next assessment type') }}</option>
                @endif
                @foreach($assessmentTypes as $assessmentType)
                    <option
                        @if(isset($teacher) && $teacher->next_assessment_type_id == $assessmentType->id)
                            selected
                        @endif
                        value="{{ $assessmentType->id }}">{{ $assessmentType->name }}</option>
            @endforeach
        </div>
    </div>
</form>
