<?php

namespace App\Http\Requests;

use App\Models\Chapter;
use App\Models\DmClass;
use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
    
            'exam_id' => [
                'bail', 'required',
                Rule::exists(Exam::class, 'id')
            ],
            'class_id' => [
                'bail', 'required',
                Rule::exists(DmClass::class, 'id')
            ],
            'subject_id' => [
                'bail', 'required',
                Rule::exists(Subject::class, 'id')
            ],
            'chapter_id' => [
                'bail', 'required',
                Rule::exists(Chapter::class, 'id')
            ],

            'question' => ['bail', 'required'],
            'option_a' => ['bail', 'required'],
            'option_b' => ['bail', 'required'],
            'option_c' => ['bail', 'required'],
            'option_d' => ['bail', 'required'],
            'answer' => ['bail', 'required', 'max:100'],
            'solution' => ['bail', 'required'],
            'question_type' => ['bail', 'required', 'max:100'],
            'year' => ['bail', 'sometimes'],      
        ];
    }
}
