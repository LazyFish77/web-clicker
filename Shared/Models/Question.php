<?php
    require_once("ISerializable.php");
    class Question implements ISerializable{

        public $id = null;
        public $status = null;
        public $question_type = null;
        public $question = null;
        public $options = null;
        public $points = null;
        public $description = null;
        public $grader = null;
        public $section = null;
        public $keywords = null;
        public $start_timestamp = null;
        public $end_timestamp = null;

        function __construct() {
        }

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

        public function Serialize() {
            return array(
                'id' => $this->id,
                'status' => $this->status,
                'question_type' => $this->question_type,
                'question' => $this->question,
                'options' => $this->options,
                'points' => $this->points,
                'description' => $this->description,
                'grader' => $this->grader,
                'section' => $this->section,
                'keywords' => $this->keywords,
                'start_timestamp' => $this->start_timestamp,
                'end_timestamp' => $this->end_timestamp
            );
        }
    }
?>