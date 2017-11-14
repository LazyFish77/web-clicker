<?php
    require_once("ISerializable.php");
    require_once("IValidatable.php");

    class Answer implements ISerializable, IValidatable {

        public $question_id = null;
        public $student_id = null;
        public $answer = null;
        public $points_earned = null;

        function __construct() {
        }

        public function Deserialize($input) {
            if(isset($input['question_id'])) {
                $this->question_id = $input['question_id'];
            }
            if(isset($input['student_id'])) {
                $this->student_id = $input['student_id'];
            }
            if(isset($input['answer'])) {
                $this->answer = $input['answer'];
            }
            if(isset($input['points_earned'])) {
                $this->points_earned = $input['points_earned'];
            }
        }

        public function Serialize() {
            return array(
                'question_id' => $this->question_id,
                'student_id' => $this->student_id,
                'answer' => $this->answer,
                'points_earned' => $this->points_earned
            );
        }

        /**
         * Logic for determining if this Question Model is in a 'valid' state
         * TODO: Add actual validation.
         */
        public function IsValid(): bool {
            if(isset($this->question_id) &&
               isset($this->student_id) &&
               isset($this->answer) &&
               isset($this->points_earned)) {
                return true;
            }
            return false;
        }
    }
?>