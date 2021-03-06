<?php
    require_once("ISerializable.php");
    require_once("IValidatable.php");

    class Question implements ISerializable, IValidatable {

        public $id = null;
        public $status = null;
        public $question_type = null;
        public $question = null;
        public $options = null;
        public $answer = null;
        public $points = null;
        public $description = null;
        public $grader = null;
        public $section = null;
        public $keywords = null;
        public $start_timestamp = null;
        public $end_timestamp = null;

        function __construct() {
        }

        /**
         * Given an assoc array, populate this model's properties
         */
        public function Deserialize($input) {
            if(isset($input['id'])) {
                $this->id = $input['id'];
            }
            if(isset($input['status'])) {
                $this->status = $input['status'];
            }
            if(isset($input['question_type'])) {
                $this->question_type = $input['question_type'];
            }
            if(isset($input['question'])) {
                $this->question = $input['question'];
            }
            if(isset($input['options'])) {
                $this->options = $input['options'];
            }
            if(isset($input['answer'])) {
                $this->answer = $input['answer'];
            }
            if(isset($input['points'])) {
                $this->points = $input['points'];
            }
            if(isset($input['description'])) {
                $this->description = $input['description'];
            }
            if(isset($input['grader'])) {
                $this->grader = $input['grader'];
            }
            if(isset($input['section'])) {
                $this->section = $input['section'];
            }
            if(isset($input['keywords'])) {
                $this->keywords = $input['keywords'];
            }
            if(isset($input['start_timestamp'])) {
                $this->start_timestamp = $input['start_timestamp'];
            }
            if(isset($input['end_timestamp'])) {
                $this->end_timestamp = $input['end_timestamp'];
            }
        }

        /**
         * Serialize this Model into an array which our database context
         * can use for updating the database entries.
         */
        public function Serialize() {
            return array(
                'id' => $this->id,
                'status' => $this->status,
                'question_type' => $this->question_type,
                'question' => $this->question,
                'options' => $this->options,
                'answer' => $this->answer,
                'points' => $this->points,
                'description' => $this->description,
                'grader' => $this->grader,
                'section' => $this->section,
                'keywords' => $this->keywords,
                'start_timestamp' => $this->start_timestamp,
                'end_timestamp' => $this->end_timestamp
            );
        }

        /**
         * Logic for determining if this Question Model is in a 'valid' state
         * TODO: Add actual validation.
         */
        public function IsValid() {
            if(!isset($this->question)) {
                return false;
            }
            return true;
        }
    }
?>