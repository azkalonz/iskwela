define({ "api": [
  {
    "type": "get",
    "url": "<HOST>/api/assignments/v2/:id",
    "title": "List Class Assignments by Schedule",
    "version": "1.0.0",
    "name": "ClassFreeStyleAssignment",
    "description": "<p>Returns list of class assignments classified by (array of)schedules</p>",
    "group": "Assignments:_Free-Style",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the class ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the schedule ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Datetime",
            "optional": false,
            "field": "from",
            "description": "<p>date/time start of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Datetime",
            "optional": false,
            "field": "to",
            "description": "<p>date/time end of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "teacher",
            "description": "<p>the teacher handling this session (could be different from the class adviser if re-assignment happens)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "teacher.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.profile_picture",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "PENDING",
              "ONGOING",
              "DONE",
              "CANCELED"
            ],
            "optional": false,
            "field": "status",
            "description": "<p>the schedule status</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "publishedAssignments",
            "description": "<p>list of published assignments for this schedule</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "publishedAssignments.id",
            "description": "<p>the assignment ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedAssignments.title",
            "description": "<p>the assignment title</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedAssignments.description",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "assignment"
            ],
            "optional": false,
            "field": "publishedAssignments.activity_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "publishedAssignments.grading_category",
            "description": "<p>the category ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "publishedAssignments.total_score",
            "description": "<p>the expected perfect score</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "publishedAssignments.due_date",
            "description": "<p>deadline for the assignment to be taken</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "published"
            ],
            "optional": false,
            "field": "publishedAssignments.status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "publishedAssignments.done",
            "description": "<p>indicates whether the assignment is open or closed.</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "publishedAssignments.materials",
            "description": "<p>list of materials attached to this assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "publishedAssignments.materials.id",
            "description": "<p>the material ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedAssignments.materials.title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedAssignments.materials.uploaded_file",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedAssignments.materials.resource_link",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "unpublishedAssignments",
            "description": "<p>list of unpublished assignments for this schedule. Available to teachers only</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "unpublishedAssignments.id",
            "description": "<p>the assignment ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "unpublishedAssignments.title",
            "description": "<p>the assignment title</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "unpublishedAssignments.description",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "assignment"
            ],
            "optional": false,
            "field": "unpublishedAssignments.activity_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "unpublishedAssignments.grading_category",
            "description": "<p>the category ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "unpublishedAssignments.total_score",
            "description": "<p>the expected perfect score</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "unpublishedAssignments.due_date",
            "description": "<p>deadline for the assignment to be taken</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "unpublished"
            ],
            "optional": false,
            "field": "unpublishedAssignments.status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "unpublishedAssignments.done",
            "description": "<p>indicates whether the assignment is open or closed.</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "unpublishedAssignments.materials",
            "description": "<p>list of materials attached to this assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "unpublishedAssignments.materials.id",
            "description": "<p>the material ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "unpublishedAssignments.materials.title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "unpublishedAssignments.materials.uploaded_file",
            "description": "<p>link to uploaded file</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "unpublishedAssignments.materials.resource_link",
            "description": "<p>a shared reference link (google docs, etc)</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 2,\n        \"from\": \"2020-05-18 09:00:00\",\n        \"to\": \"2020-05-18 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\",\n            \"profile_picture\": \"https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/NuAwve8r1j20KLNde6HjFQVhxGp4Q69p0KO38wIL.jpeg\"\n        },\n        \"status\": \"PENDING\",\n        \"publishedAssignments\": [\n            {\n                \"id\": 6,\n                \"title\": \"New Assignment Test\",\n                \"description\": \"Assignment description\",\n                \"activity_type\": \"assignment\",\n                \"grading_category\": 1,\n                \"total_score\": 100,\n                \"due_date\": \"2020-07-10 10:00:00\",\n                \"status\": \"published\",\n                \"done\": \"false\",\n                \"materials\": [\n                    {\n                        \"id\": 6,\n                        \"title\": \"Test Title 2\",\n                        \"uploaded_file\": \"\",\n                        \"resource_link\": \"sample-activity-material-link3.com\"\n                    }\n                ]\n            }\n        ],\n        \"unpublishedAssignments\": [\n            {\n                \"id\": 3,\n                \"title\": \"New assignment Test\",\n                \"description\": \"Assignments description\",\n                \"activity_type\": \"assignment\",\n                \"grading_category\": 1,\n                \"total_score\": 100,\n                \"due_date\": \"2020-07-10 10:00:00\",\n                \"status\": \"unpublished\",\n                \"done\": \"false\",\n                \"materials\": []\n            },\n            {\n                \"id\": 8,\n                \"title\": \"New Assignment Test\",\n                \"description\": \"Assigment description\",\n                \"activity_type\": \"assignment\",\n                \"grading_category\": 1,\n                \"total_score\": 100,\n                \"due_date\": \"2020-07-10 10:00:00\",\n                \"status\": \"unpublished\",\n                \"done\": \"false\",\n                \"materials\": []\n            }\n        ]\n    },\n    {},\n    {}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ScheduleController.php",
    "groupTitle": "Assignments:_Free-Style",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/assignment/v2/remove/:id",
    "title": "Delete Assigment",
    "version": "1.0.0",
    "name": "FreeStyleAssignmentDelete",
    "description": "<p>Delete the assignment</p>",
    "group": "Assignments:_Free-Style",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of assignment to be deleted</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Assignments:_Free-Style",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/assignment/v2/mark-done/:id",
    "title": "Mark Done",
    "version": "1.0.0",
    "name": "FreeStyleAssignmentDone",
    "description": "<p>Mark assignment to done</p>",
    "group": "Assignments:_Free-Style",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of assignment to be done/closed</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Assignments:_Free-Style",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/assignment/v2/mark-not-done/:id",
    "title": "Mark Undone",
    "version": "1.0.0",
    "name": "FreeStyleAssignmentUndone",
    "description": "<p>Mark assignment to undone</p>",
    "group": "Assignments:_Free-Style",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of assignment to be undone/open</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Assignments:_Free-Style",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/assignment/v2/get-score/:id",
    "title": "Get Assignment Score",
    "version": "1.0.0",
    "name": "GetFreeStyleAssignmentScore",
    "description": "<p>Shows the score of student(s) of the given assignment ID</p>",
    "group": "Assignments:_Free-Style",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": "<p>the student ID. If not provided, displays scores of all students in the class</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>score record ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "activity_id",
            "description": "<p>the assignment ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "score",
            "description": "<p>achieved points</p>"
          },
          {
            "group": "Success 200",
            "type": "Double",
            "optional": false,
            "field": "score_percentage",
            "description": "<p>score rating</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "\t\t{\n            \"id\": 2,\n            \"student_id\": \"2\",\n            \"activity_id\": \"4\",\n            \"score\": \"80\",\n            \"score_percentage\": 0.8\n        }",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityScoreController.php",
    "groupTitle": "Assignments:_Free-Style",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/assignment/v2/set-score",
    "title": "Set Assignment Score",
    "version": "1.0.0",
    "name": "SetFreeStyleAssignmentScore",
    "description": "<p>Sets a student assignment score</p>",
    "group": "Assignments:_Free-Style",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "score",
            "description": "<p>score of the student</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": "<p>user ID of the student</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "activity_id",
            "description": "<p>activity ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>score record ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "activity_id",
            "description": "<p>the assignment ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "score",
            "description": "<p>achieved points</p>"
          },
          {
            "group": "Success 200",
            "type": "Double",
            "optional": false,
            "field": "score_percentage",
            "description": "<p>score rating</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "\t\t{\n            \"id\": 2,\n            \"student_id\": \"2\",\n            \"activity_id\": \"4\",\n            \"score\": \"80\",\n            \"score_percentage\": 0.8\n        }",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityScoreController.php",
    "groupTitle": "Assignments:_Free-Style",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/assignment/v2/view-answers/:id",
    "title": "View Answers",
    "version": "1.0.0",
    "name": "ShowFreeStyleAssignmentAnswer",
    "description": "<p>Show the student's answer of the given assignment</p>",
    "group": "Assignments:_Free-Style",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the assignment ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": true,
            "field": "student_id",
            "description": "<p>if supplied, returns the answer of the specific student only</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>record ID of the answer</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "assignment_id",
            "description": "<p>the assignment ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "answer_media",
            "description": "<p>link to the uploaded answer</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "student",
            "description": "<p>student details who submitted the answer</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "student.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "student.last_name",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 3,\n        \"assignment_id\": 6,\n        \"answer_media\": \"http://api.schoolhub.local:8080/api/download/activity/answer/3\",\n        \"answer_text\": \"Answer Text Sample\",\n        \"student\": {\n            \"id\": 1,\n            \"first_name\": \"jayson\",\n            \"last_name\": \"barino\"\n        }\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentAnswerController.php",
    "groupTitle": "Assignments:_Free-Style",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/assignment/v2/upload/answer",
    "title": "Upload Answer (For student)",
    "version": "1.0.0",
    "name": "UploadFreeStyleAssignmentAnswer",
    "description": "<p>Upload assignment answer</p>",
    "group": "Assignments:_Free-Style",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "File",
            "allowedValues": [
              "*.jpeg",
              "*.bmp",
              "*.png",
              "*.gif",
              "*.pdf",
              "*.doc",
              "*.txt"
            ],
            "optional": false,
            "field": "file",
            "description": "<p>The file to be uploaded</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "assignment_id",
            "description": "<p>the activity id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "answer_text",
            "description": "<p>free text answer</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/FileController.php",
    "groupTitle": "Assignments:_Free-Style",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/assignment/v2/upload/material",
    "title": "Add Material (FILE)",
    "version": "1.0.0",
    "name": "UploadFreestyleAssignmentMaterial",
    "description": "<p>Upload assignment material/resource for student's reference</p>",
    "group": "Assignments:_Free-Style",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "File",
            "allowedValues": [
              "*.jpeg",
              "*.bmp",
              "*.png",
              "*.gif",
              "*.pdf",
              "*.doc",
              "*.txt"
            ],
            "optional": false,
            "field": "file",
            "description": "<p>The file to be uploaded</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "assignment_id",
            "description": "<p>the activity id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>file title</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/FileController.php",
    "groupTitle": "Assignments:_Free-Style",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/assignment/v2/save",
    "title": "Add/Edit Assignment",
    "version": "1.0.0",
    "name": "addFreeStyleAssignment",
    "description": "<p>Add new free-style assignment</p>",
    "group": "Assignments:_Free-Style",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>title of assignment</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "DateTime",
            "optional": false,
            "field": "due_date",
            "description": "<p>deadline of assignment to be submitted</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "published",
            "description": "<p>0: not published, 1:published</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "subject_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "schedule_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "total_score",
            "description": "<p>the expected perfect score for this assignment</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "grading_category",
            "description": "<p>the grading category ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of the created assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "assignment"
            ],
            "optional": false,
            "field": "activity_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "grading_category",
            "description": "<p>the grading category ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "total_score",
            "description": "<p>the expected perfect score for this assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "due_date",
            "description": "<p>deadline of assignment to be submitted</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "unpublished",
              "published"
            ],
            "optional": false,
            "field": "status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "done",
            "description": "<p>indicates if assignment is closed/open for takes</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "materials",
            "description": "<p>array of materials attached to the assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "materials.id",
            "description": "<p>material ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.title",
            "description": "<p>material title</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.uploaded_file",
            "description": "<p>link to uploaded file if any</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.resource_link",
            "description": "<p>URL link to resource</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 5,\n    \"title\": \"New assignment Test\",\n    \"description\": \"assignment free description\",\n    \"activity_type\": \"assignment\",\n    \"grading_category\": 1,\n    \"total_score\": 100,\n    \"due_date\": \"2020-07-10 10:00:00\",\n    \"status\": \"unpublished\",\n    \"done\": \"false\",\n    \"materials\": [\n        {\n            \"id\": 4,\n            \"title\": \"Test assignment 2\",\n            \"uploaded_file\": \"\",\n            \"resource_link\": \"sample-activity-material-link3.com\"\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Assignments:_Free-Style",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/assignment/v2/material/save",
    "title": "Add/Edit Material (URL)",
    "version": "1.0.0",
    "name": "addFreeStyleAssignmentMaterialUrl",
    "description": "<p>Add a link to assignments's material</p>",
    "group": "Assignments:_Free-Style",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": true,
            "field": "id",
            "description": "<p>if supplied, edits the existing material</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "activity_id",
            "description": "<p>ID of assignment</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>link to resource</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the ID of added material</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "uploaded_file",
            "description": "<p>link to uploaded file if any</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "resource_link",
            "description": "<p>URL to resource</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 7,\n    \"title\": \"Test Title 2\",\n    \"uploaded_file\": \"\",\n    \"resource_link\": \"sample-activity-material-link3.com\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Assignments:_Free-Style",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/assignment/v2/publish/:id",
    "title": "Publish Assignment",
    "version": "1.0.0",
    "name": "publishFreeStyleAssignment",
    "description": "<p>Publish seatwork to be available for students</p>",
    "group": "Assignments:_Free-Style",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of assignment to be published</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Assignments:_Free-Style",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/assignment/v2/remove/material/:id",
    "title": "Delete Assignment Material",
    "version": "1.0.0",
    "name": "removeFreeStyleAssignmentMaterial",
    "description": "<p>Remove attached material from the assignment</p>",
    "group": "Assignments:_Free-Style",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the assignment ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Assignments:_Free-Style",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "HOST/api/assignment/v2/:id",
    "title": "Assignment Details",
    "version": "1.0.0",
    "name": "showFreeStyleAssignment",
    "description": "<p>Show assignment details</p>",
    "group": "Assignments:_Free-Style",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of assignment to be viewed</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Assignments:_Free-Style",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of the created assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "assignment"
            ],
            "optional": false,
            "field": "activity_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "grading_category",
            "description": "<p>the grading category ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "total_score",
            "description": "<p>the expected perfect score for this assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "due_date",
            "description": "<p>deadline of assignment to be submitted</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "unpublished",
              "published"
            ],
            "optional": false,
            "field": "status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "done",
            "description": "<p>indicates if assignment is closed/open for takes</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "materials",
            "description": "<p>array of materials attached to the assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "materials.id",
            "description": "<p>material ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.title",
            "description": "<p>material title</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.uploaded_file",
            "description": "<p>link to uploaded file if any</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.resource_link",
            "description": "<p>URL link to resource</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 6,\n    \"title\": \"New Assignment Test\",\n    \"description\": \"Assignment description\",\n    \"activity_type\": \"assignment\",\n    \"grading_category\": 1,\n    \"total_score\": 100,\n    \"due_date\": \"2020-07-10 10:00:00\",\n    \"status\": \"unpublished\",\n    \"done\": \"false\",\n    \"materials\": [\n        {\n            \"id\": 4,\n            \"title\": \"Test assignment 2\",\n            \"uploaded_file\": \"\",\n            \"resource_link\": \"sample-activity-material-link3.com\"\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/assignment/save",
    "title": "Add/Edit assignment",
    "version": "1.0.0",
    "name": "AddAssignment",
    "description": "<p>Saves a new assignment with attached questionnaires</p>",
    "group": "Assignments:_Questionnaire",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": true,
            "field": "activity_id",
            "description": "<p>if provided, edits the existing record</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "questionnaires"
            ],
            "optional": true,
            "field": "include",
            "description": "<p>if specified, includes the questionnaire details in response data</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>the assignment title</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "instruction",
            "description": "<p>descriptions/instructions/introduction texts</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "duration",
            "description": "<p>time limit on answering this class</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "category_id",
            "description": "<p>to which category this assignment should be: written, performance, etc (whatever is defined by the school)</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "subject_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>array of questionnaire IDs attached to the assignment</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.id",
            "description": "<p>questionnaire ID attached by teacher</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of newly created assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "instruction",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "duration",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activity_availability_status",
            "description": "<p>OPEN by default</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "subject",
            "description": "<p>subject details</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.subject_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "category",
            "description": "<p>the category details</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category.school_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "category.category",
            "description": "<p>the category title</p>"
          },
          {
            "group": "Success 200",
            "type": "Float",
            "optional": false,
            "field": "category.category_percentage",
            "description": "<p>the weight of the category in overall grade calculation</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>refer to <a href='#api-Questionnaire-QuestionnaireDetail'><font color='blue'><HOST>/api/questionnaire/:id</font></a> for the questionnaire details</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"id\": 21,\n\t\"title\": \"assignment - written\",\n\t\"instruction\": \"answer this\",\n\t\"duration\": 60,\n\t\"activity_availability_status\": \"OPEN\",\n\t\"subject\": {\n\t\t\"id\": 2,\n\t\t\"subject_name\": \"Filipino\"\n\t},\n\t\"category\": {\n\t\t\"id\": 1,\n\t\t\"school_id\": 1,\n\t\t\"category\": \"Written Works\",\n\t\t\"category_percentage\": \"0.3\"\n\t},\n\t\"questionnaires\": [\n\t\t{\n\t\t\t\"id\": 2,\n\t\t\t\"title\": \"Questionnaire 1\",\n\t\t\t\"intro\": \"this is a quiz to answer\",\n\t\t\t\"subject_id\": 1,\n\t\t\t\"school_published\": 0,\n\t\t\t\"school_published_date\": null,\n\t\t\t\"author\": {\n\t\t\t\t\"id\": 8,\n\t\t\t\t\"first_name\": \"teacher tom\",\n\t\t\t\t\"last_name\": \"cruz\"\n\t\t\t},\n\t\t\t\"questions\": [\n\t\t\t\t{\n\t\t\t\t\t\"id\": 3,\n\t\t\t\t\t\"question\": \"test\",\n\t\t\t\t\t\"question_type\": \"mcq\",\n\t\t\t\t\t\"media_url\": \"http://sample-media.com/q1-quiz1\",\n\t\t\t\t\t\"weight\": 1,\n\t\t\t\t\t\"choices\": [\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"d\",\n\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"e\",\n\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t}\n\t\t\t\t\t]\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"id\": 4,\n\t\t\t\t\t\"question\": \"test2\",\n\t\t\t\t\t\"question_type\": \"mcq\",\n\t\t\t\t\t\"media_url\": \"http://sample-media.com/q2-quiz1\",\n\t\t\t\t\t\"weight\": 5,\n\t\t\t\t\t\"choices\": [\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t}\n\t\t\t\t\t]\n\t\t\t\t}\n\t\t\t]\n\t\t}\n\t]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Assignments:_Questionnaire",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/assignment/questionnaire/add",
    "title": "Add Questionnaire",
    "version": "1.0.0",
    "name": "AddAssignmentQuestionnaire",
    "description": "<p>Allows adding more questionnaires to the existing assignment</p>",
    "group": "Assignments:_Questionnaire",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the ID of the assignment</p>"
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>array of questionnaire IDs to be added to the assignment</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.id",
            "description": "<p>the questionnaire ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Assignments:_Questionnaire",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/assignment/close/:id",
    "title": "Close Assignment (for Teacher)",
    "version": "1.0.0",
    "name": "AssignmentClose",
    "description": "<p>Close the assignment to prevent the student from taking the assignment</p>",
    "group": "Assignments:_Questionnaire",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the assingment ID</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\"success\": true}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Assignments:_Questionnaire",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/assignment/complete/:id",
    "title": "Complete Assignment (for Student)",
    "version": "1.0.0",
    "name": "AssignmentComplete",
    "description": "<p>Mark assignment as complete (student side)</p>",
    "group": "Assignments:_Questionnaire",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the assignment ID</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\"success\": true}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Assignments:_Questionnaire",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/assignment/:id",
    "title": "Get Assignment Detail",
    "version": "1.0.0",
    "name": "AssignmentDetail",
    "description": "<p>Returns details of the specified assignment ID</p>",
    "group": "Assignments:_Questionnaire",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "questionnaires"
            ],
            "optional": true,
            "field": "include",
            "description": "<p>if specified, includes the questionnaire details in response data</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the assignment ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "instruction",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "duration",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activity_availability_status",
            "description": "<p>OPEN/CLOSED</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "submission_status",
            "description": "<p>available in student profile only. Values: TO DO/ONGOING/DONE</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTimeOrNull",
            "optional": false,
            "field": "submission_date",
            "description": "<p>available in student profile only</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "subject",
            "description": "<p>subject details</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.subject_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "published",
            "description": "<p>flag if quiz is published to class or not</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "category",
            "description": "<p>the category details</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category.school_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "category.category",
            "description": "<p>the category title</p>"
          },
          {
            "group": "Success 200",
            "type": "Float",
            "optional": false,
            "field": "category.category_percentage",
            "description": "<p>the weight of the category in overall grade calculation</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>refer to <a href='#api-Questionnaire-QuestionnaireDetail'><font color='blue'><HOST>/api/questionnaire/:id</font></a> for the questionnaire details</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "\t\t{\n\t\t\t\"id\": 17,\n\t\t\t\"title\": \"quiz2 - written\",\n\t\t\t\"instruction\": \"answer this\",\n\t\t\t\"duration\": 60,\n\t\t\t\"activity_availability_status\": \"OPEN\",\n\t\t\t\"submission_status\": \"DONE\",\n    \t\t\"submission_date\": \"2020-08-29 10:56:18\",\n\t\t\t\"subject\": {\n\t\t\t\t\"id\": 1,\n\t\t\t\t\"subject_name\": \"English\"\n\t\t\t},\n\t\t\t\"category\": {\n\t\t\t\t\"id\": 1,\n\t\t\t\t\"school_id\": 1,\n\t\t\t\t\"category\": \"Written Works\",\n\t\t\t\t\"category_percentage\": \"0.3\"\n\t\t\t},\n\t\t\t\"questionnaires\": [\n\t\t\t\t{\n\t\t\t\t\t\"id\": 2,\n\t\t\t\t\t\"title\": \"Questionnaire 1\",\n\t\t\t\t\t\"intro\": \"this is a quiz to answer\",\n\t\t\t\t\t\"subject_id\": 1,\n\t\t\t\t\t\"school_published\": 0,\n\t\t\t\t\t\"school_published_date\": null,\n\t\t\t\t\t\"author\": {\n\t\t\t\t\t\t\"id\": 8,\n\t\t\t\t\t\t\"first_name\": \"teacher tom\",\n\t\t\t\t\t\t\"last_name\": \"cruz\"\n\t\t\t\t\t},\n\t\t\t\t\t\"questions\": [\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"id\": 3,\n\t\t\t\t\t\t\t\"question\": \"test\",\n\t\t\t\t\t\t\t\"question_type\": \"mcq\",\n\t\t\t\t\t\t\t\"media_url\": \"http://sample-media.com/q1-quiz1\",\n\t\t\t\t\t\t\t\"weight\": 1,\n\t\t\t\t\t\t\t\"choices\": [\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"d\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"e\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t}\n\t\t\t\t\t\t\t]\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"id\": 4,\n\t\t\t\t\t\t\t\"question\": \"test2\",\n\t\t\t\t\t\t\t\"question_type\": \"mcq\",\n\t\t\t\t\t\t\t\"media_url\": \"http://sample-media.com/q2-quiz1\",\n\t\t\t\t\t\t\t\"weight\": 5,\n\t\t\t\t\t\t\t\"choices\": [\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t\t}\n\t\t\t\t\t\t\t]\n\t\t\t\t\t\t}\n\t\t\t\t\t]\n\t\t\t\t}\n\t\t\t]\n\t\t}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Assignments:_Questionnaire",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "delete",
    "url": "<HOST>/api/assignment/delete/:id",
    "title": "Delete Assignment",
    "version": "1.0.0",
    "name": "DeleteAssignment",
    "description": "<p>Delete the assignment from the assignment bank</p>",
    "group": "Assignments:_Questionnaire",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Assignments:_Questionnaire",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/assignments",
    "title": "Get Assignments",
    "version": "1.0.0",
    "name": "ListAssignments",
    "description": "<p>Returns array of assignments</p>",
    "group": "Assignments:_Questionnaire",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "questionnaires"
            ],
            "optional": true,
            "field": "include",
            "description": "<p>if specified, includes the questionnaire details in response data</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>filter the list to return published assignments to the class.<br> OPTIONAL for teacher; and if not specified, returns all the assignments created by teacher<br><br> REQUIRED for school admin and students.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "subject_id",
            "description": "<p>filter the list to return periodiclas of the specified subject only.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "teacher_id",
            "description": "<p>required if logged in as school admin (for viewing the list of assignments published by the specified teacher_id)</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "schedule_id",
            "description": "<p>required if class_id is provided</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "the",
            "description": "<p>assignment ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "instruction",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "duration",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activity_availability_status",
            "description": "<p>OPEN/CLOSED</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "submission_status",
            "description": "<p>available in student profile only. Values: TO DO/ONGOING/DONE</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTimeOrNull",
            "optional": false,
            "field": "submission_date",
            "description": "<p>available in student profile only</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "subject",
            "description": "<p>subject details</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.subject_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "published",
            "description": "<p>flag if quiz is published to class or not</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "category",
            "description": "<p>the category details</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category.school_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "category.category",
            "description": "<p>the category title</p>"
          },
          {
            "group": "Success 200",
            "type": "Float",
            "optional": false,
            "field": "category.category_percentage",
            "description": "<p>the weight of the category in overall grade calculation</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>refer to <a href='#api-Questionnaire-QuestionnaireDetail'><font color='blue'><HOST>/api/questionnaire/:id</font></a> for the questionnaire details</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n\t{\n\t\t\"id\": 21,\n\t\t\"title\": \"assignment - written\",\n\t\t\"instruction\": \"answer this\",\n\t\t\"duration\": 60,\n\t\t\"activity_availability_status\": \"CLOSED\",\n\t\t\"submission_status\": \"DONE\",\n\t\t\"submission_date\": \"2020-08-29 10:56:18\",\n\t\t\"subject\": {\n\t\t\t\"id\": 2,\n\t\t\t\"subject_name\": \"Filipino\"\n\t\t},\n\t\t\"category\": {\n\t\t\t\"id\": 1,\n\t\t\t\"school_id\": 1,\n\t\t\t\"category\": \"Written Works\",\n\t\t\t\"category_percentage\": \"0.3\"\n\t\t},\n\t\t\"questionnaires\": [\n\t\t\t{\n\t\t\t\t\"id\": 2,\n\t\t\t\t\"title\": \"Questionnaire 1\",\n\t\t\t\t\"intro\": \"this is a quiz to answer\",\n\t\t\t\t\"subject_id\": 1,\n\t\t\t\t\"school_published\": 0,\n\t\t\t\t\"school_published_date\": null,\n\t\t\t\t\"author\": {\n\t\t\t\t\t\"id\": 8,\n\t\t\t\t\t\"first_name\": \"teacher tom\",\n\t\t\t\t\t\"last_name\": \"cruz\"\n\t\t\t\t},\n\t\t\t\t\"questions\": [\n\t\t\t\t\t{\n\t\t\t\t\t\t\"id\": 3,\n\t\t\t\t\t\t\"question\": \"test\",\n\t\t\t\t\t\t\"question_type\": \"mcq\",\n\t\t\t\t\t\t\"media_url\": \"http://sample-media.com/q1-quiz1\",\n\t\t\t\t\t\t\"weight\": 1,\n\t\t\t\t\t\t\"choices\": [\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\"option\": \"d\",\n\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\"option\": \"e\",\n\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t}\n\t\t\t\t\t\t]\n\t\t\t\t\t},\n\t\t\t\t\t{\n\t\t\t\t\t\t\"id\": 4,\n\t\t\t\t\t\t\"question\": \"test2\",\n\t\t\t\t\t\t\"question_type\": \"mcq\",\n\t\t\t\t\t\t\"media_url\": \"http://sample-media.com/q2-quiz1\",\n\t\t\t\t\t\t\"weight\": 5,\n\t\t\t\t\t\t\"choices\": [\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t}\n\t\t\t\t\t\t]\n\t\t\t\t\t}\n\t\t\t\t]\n\t\t\t},\n\t\t\t{}\n\t\t]\n\t}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Assignments:_Questionnaire",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/assignment/publish",
    "title": "Publish Assignment",
    "version": "1.0.0",
    "name": "PublishAssignment",
    "description": "<p>Publishes the assignment to class</p>",
    "group": "Assignments:_Questionnaire",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the ID of the assignment to be published</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>the target class where the assignment will be published to</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "schedule_id",
            "description": "<p>which schedule the assignment should be published</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Assignments:_Questionnaire",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/assignment/questionnaire/remove",
    "title": "Remove Questionnaire",
    "version": "1.0.0",
    "name": "RemoveAssignmentQuestionnaire",
    "description": "<p>Allows removing questionnaires to the existing assignment. Only one questionnaire can be removed at a time</p>",
    "group": "Assignments:_Questionnaire",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the ID of the assignment</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "questionnaire_id",
            "description": "<p>the ID of the questionnaire to be removed</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Assignments:_Questionnaire",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/assignment/answer/submit",
    "title": "Submit Assignment Questionnaire (answers)",
    "version": "1.0.0",
    "name": "SubmitAssignment",
    "description": "<p>Allows submission of assignment answer</p>",
    "group": "Assignments:_Questionnaire",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "activity_id",
            "description": "<p>the assignment ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "subject_id",
            "description": "<p>the subject ID</p>"
          },
          {
            "group": "Parameter",
            "type": "DateTime",
            "optional": false,
            "field": "start_time",
            "description": "<p>the time when the student starts the assignment</p>"
          },
          {
            "group": "Parameter",
            "type": "DateTime",
            "optional": false,
            "field": "end_time",
            "description": "<p>the time when the student finishes the assignment</p>"
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>the array of questionnaires with answers</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.questionnaire_id",
            "description": "<p>the ID of questionnaire</p>"
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "questionnaires.answers",
            "description": "<p>answer details and remarks</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.answers.question_id",
            "description": "<p>the question ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.answers.status",
            "description": "<p><i>PLACEHOLDER <br><br> 0: first try, 1: retried, 2:skip</i></p>"
          },
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "questionnaires.answers.is_correct",
            "description": "<p>marks if the answer is wrong/correct</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "questionnaires.answers.answer",
            "description": "<p>the actual answer string</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the assignment ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "score",
            "description": "<p>the actual score of student</p>"
          },
          {
            "group": "Success 200",
            "type": "Double",
            "optional": false,
            "field": "score_percentage",
            "description": "<p>the student's score percentage</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "perfect",
            "description": "<p>the total score of the assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "duration",
            "description": "<p>student's time in answerting the assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>details of students's answers</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.id",
            "description": "<p>the questionnaire ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.activity_record_id",
            "description": "<p>record ID of this attempt</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questionnaires.answers",
            "description": "<p>answer details and remarks</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.answers.id",
            "description": "<p>record ID of this answer</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.answers.question_id",
            "description": "<p>the question which this answer is for</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.answers.status",
            "description": "<p><i>PLACEHOLDER</i></p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.answers.is_correct",
            "description": "<p>answer remark</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "questionnaires.answers.answer",
            "description": "<p>the actual answer string</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 24,\n    \"score\": 7,\n    \"score_percentage\": 0.58,\n    \"pefect_score\": 12,\n    \"duration\": 1500,\n    \"questionnaires\": [\n        {\n            \"questionnaire_id\": 5,\n            \"activity_record_id\": 39,\n            \"answers\": [\n                {\n                    \"id\": 77,\n                    \"question_id\": 9,\n                    \"status\": 0,\n                    \"is_correct\": 1,\n                    \"answer\": \"test 3\"\n                },\n                {\n                    \"id\": 78,\n                    \"question_id\": 10,\n                    \"status\": 0,\n                    \"is_correct\": 1,\n                    \"answer\": \"test 4\"\n                }\n            ]\n        },\n        {\n            \"questionnaire_id\": 6,\n            \"activity_record_id\": 40,\n            \"answers\": [\n                {\n                    \"id\": 79,\n                    \"question_id\": 11,\n                    \"status\": 0,\n                    \"is_correct\": 1,\n                    \"answer\": \"test 5\"\n                },\n                {\n                    \"id\": 80,\n                    \"question_id\": 12,\n                    \"status\": 0,\n                    \"is_correct\": 0,\n                    \"answer\": \"test 6\"\n                }\n            ]\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityAnswerController.php",
    "groupTitle": "Assignments:_Questionnaire",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/assignment/unpublish",
    "title": "Unpublish Assignment",
    "version": "1.0.0",
    "name": "UnpublishAssignment",
    "description": "<p>Removes the assignment from the class</p>",
    "group": "Assignments:_Questionnaire",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the ID of the assignment to be unpublished</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>which class the assignment will be removed from</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Assignments:_Questionnaire",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "HOST/api/changePassword",
    "title": "User Change Password",
    "version": "1.0.0",
    "name": "ChangePassword",
    "description": "<p>Changes password for a given user ID. Returns HTTP error code 401 if supplied credentials is invalid</p>",
    "group": "Auth",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>username/student ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>new password</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "current_password",
            "description": "<p>old password</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>returns true if change password is successful</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n     \"success\": true\n }",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/AuthController.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "HOST/api/auth/jitsi",
    "title": "Jitsi Login",
    "version": "1.0.0",
    "name": "jitsilogin",
    "description": "<p>Generates JWT for jitsi server authentication</p>",
    "group": "Auth",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>ID of the class to join in</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "access_token",
            "description": "<p>The auth token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"access_token\": \"eyiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJqaXRzaSIsImlzcyI6InNjaG9vbGh1YiIsInN1YiI6Imp0cy5pc2t3ZWxhLmV4cCI6MTU5NDAyNjE1NCwicm9vbSI6IjEyMzQ1NiJ9.3RMuPoEL-zeAmXkAzqoX2MbVBm_mVvS15EcOtEasNGw\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/AuthController.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "HOST/api/login",
    "title": "User login",
    "version": "1.0.0",
    "name": "login",
    "description": "<p>Generates token for user</p>",
    "group": "Auth",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>Username/student ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>password entered by user.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "access_token",
            "description": "<p>The auth token</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "Bearer"
            ],
            "optional": false,
            "field": "token_type",
            "description": "<p>Defined class name</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "expires_in",
            "description": "<p>Token lifespan</p>"
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "change_password_required",
            "description": "<p>Flag that tells whether user needs to change password</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"access_token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90YWxpbmEubG9jYWw6ODA4MFwvYXBpXC9sb2dpbiIsImlhdCI6MTU4OTE5OTE4NSwiZXhwIjoxNTg5MjAyNzg1LCJuYmYiOjE1ODkxOTkxODUsImp0aSI6ImN2TVhWakdhNjRTT0x3NmkiLCJzdWIiOiJKREpWSkdELTdhbjZlbDUiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3Iiwia2V5Ijo4fQ.V_9sTyiSHk5VuaIm6uy3cGzigvqDRBoL4Ek7SjR49Vg\",\n    \"token_type\": \"Bearer\",\n    \"expires_in\": 3600,\n    \"change_password_required\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/AuthController.php",
    "groupTitle": "Auth"
  },
  {
    "type": "POST",
    "url": "HOST/api/class/class-material/mark-done/:id",
    "title": "Class Material Mark Done",
    "version": "1.0.0",
    "name": "ClassMaterialMarkDone",
    "description": "<p>Marks Class Material as Done</p>",
    "group": "Class_Materials",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of class material</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ClassMaterialController.php",
    "groupTitle": "Class_Materials",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/class/class-material/mark-not-done/:id",
    "title": "Class Material Mark Not Done",
    "version": "1.0.0",
    "name": "ClassMaterialMarkNotDone",
    "description": "<p>Marks Class Material as Not Done</p>",
    "group": "Class_Materials",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of class material</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ClassMaterialController.php",
    "groupTitle": "Class_Materials",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "HOST/api/class/material/save",
    "title": "Save Class Material",
    "version": "1.0.0",
    "name": "SaveClassMaterial",
    "description": "<p>Saves a Class Material</p>",
    "group": "Class_Materials",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of Class Material. if exists, updates the specified class Material ID, otherwise, creates new.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>Class ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "schedule_id",
            "description": "<p>Schedule ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>Link to class material</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>Title of the Class Material</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Class Material ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>Class Material Title</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "uploaded_file",
            "description": "<p>file uploaded if exits.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "resource_link",
            "description": "<p>link to class material</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "added_by",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "added_by.id",
            "description": "<p>teacher ID who added the class material</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.first_name",
            "description": "<p>first name of the teacher</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.last_name",
            "description": "<p>last name of the teacher</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 16,\n    \"title\": \"Sample Title2\",\n    \"uploaded_file\": \"\",\n    \"resource_link\": \"sample-class-material-link2.com\",\n    \"added_by\": {\n        \"id\": 8,\n        \"first_name\": \"teacher tom\",\n        \"last_name\": \"cruz\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ClassMaterialController.php",
    "groupTitle": "Class_Materials"
  },
  {
    "type": "post",
    "url": "HOST/api/class/material/publish/:id",
    "title": "Publish class material",
    "version": "1.0.0",
    "name": "publishClassMaterial",
    "description": "<p>Sets class material status to publish</p>",
    "group": "Class_Materials",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the class material ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ClassMaterialController.php",
    "groupTitle": "Class_Materials",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "HOST/api/class/material/unpublish/:id",
    "title": "Unpublish class material",
    "version": "1.0.0",
    "name": "unpublishClassMaterial",
    "description": "<p>Sets class material status to unpublish</p>",
    "group": "Class_Materials",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the class material ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ClassMaterialController.php",
    "groupTitle": "Class_Materials",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/download/activity/answer/:id",
    "title": "Activity Answer",
    "version": "1.0.0",
    "name": "DownloadActivityAnswer",
    "description": "<p>Downloads the activity answer</p>",
    "group": "File_Download",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Activity answer ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "BLOB",
            "optional": false,
            "field": "the",
            "description": "<p>attached file</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/Api/FileController.php",
    "groupTitle": "File_Download",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/download/activity/material/:id",
    "title": "Activity Material",
    "version": "1.0.0",
    "name": "DownloadActivityMaterial",
    "description": "<p>Downloads the activity material</p>",
    "group": "File_Download",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Activity material ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "BLOB",
            "optional": false,
            "field": "the",
            "description": "<p>attached file</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/Api/FileController.php",
    "groupTitle": "File_Download",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/download/class/image",
    "title": "Download Class Image",
    "version": "1.0.0",
    "name": "DownloadClassImage",
    "description": "<p>Download class image</p>",
    "group": "File_Download",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Class ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "BLOB",
            "optional": false,
            "field": "file",
            "description": "<p>the attached file. Returns 404 if not found.</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/Api/FileController.php",
    "groupTitle": "File_Download",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/download/class/material/:id",
    "title": "Class Instruction Material",
    "version": "1.0.0",
    "name": "DownloadClassMaterial",
    "description": "<p>Downloads the class material</p>",
    "group": "File_Download",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Class material ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "BLOB",
            "optional": false,
            "field": "file",
            "description": "<p>the attached file</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/Api/FileController.php",
    "groupTitle": "File_Download",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/do/image/url",
    "title": "Download Image from URL",
    "version": "1.0.0",
    "name": "DownloadImageURL",
    "description": "<p>Downloads the image from a given URL and upload to iSkwela's DO public space</p>",
    "group": "File_Download",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "download_url",
            "description": "<p>URL of image to download</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>the URL of image in DO space</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"url\": \"https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/2HcfRWiuJHcKKWKms44q4w4zvVvhEwDWaUALju0A.jpeg\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/FileController.php",
    "groupTitle": "File_Download",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/download/class/lesson-plan/:id",
    "title": "Lesson Plan",
    "version": "1.0.0",
    "name": "DownloadLessonPlan",
    "description": "<p>Downloads the lesson plan</p>",
    "group": "File_Download",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Lesson Plan ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "BLOB",
            "optional": false,
            "field": "the",
            "description": "<p>attached file</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/Api/FileController.php",
    "groupTitle": "File_Download",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/download/user/profile-picture",
    "title": "Profile Picture",
    "version": "1.0.0",
    "name": "DownloadProfilePicture",
    "description": "<p>Returns the url of auth user's profile picture</p>",
    "group": "File_Download",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>User ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "BLOB",
            "optional": false,
            "field": "file",
            "description": "<p>the attached file. Returns 404 if not found.</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/Api/FileController.php",
    "groupTitle": "File_Download",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/upload/class/image",
    "title": "Upload Class Image",
    "version": "1.0.0",
    "name": "UploadClassImage",
    "description": "<p>Add or Edit a class image</p>",
    "group": "File_Upload",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "File",
            "allowedValues": [
              "*.jpeg",
              "*.bmp",
              "*.png",
              "*.gif"
            ],
            "optional": false,
            "field": "file",
            "description": "<p>The file to be uploaded</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/FileController.php",
    "groupTitle": "File_Upload",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/upload/class/lesson_plan",
    "title": "Class Lesson Plan",
    "version": "1.0.0",
    "name": "UploadClassLessonPlan",
    "description": "<p>Allows adding media to lesson plan</p>",
    "group": "File_Upload",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "File",
            "allowedValues": [
              "*.jpeg",
              "*.bmp",
              "*.png",
              "*.gif",
              "*.pdf",
              "*.doc",
              "*.txt"
            ],
            "optional": false,
            "field": "file",
            "description": "<p>The file to be uploaded</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "schedule_id",
            "description": "<p>the schedule id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>title of the Lesson Plan</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>the class ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/FileController.php",
    "groupTitle": "File_Upload",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/upload/class/material",
    "title": "Class Instruction Material",
    "version": "1.0.0",
    "name": "UploadClassMaterial",
    "description": "<p>Allows adding class instruction materials</p>",
    "group": "File_Upload",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "File",
            "allowedValues": [
              "*.jpeg",
              "*.bmp",
              "*.png",
              "*.gif",
              "*.pdf",
              "*.doc",
              "*.txt"
            ],
            "optional": false,
            "field": "file",
            "description": "<p>The file to be uploaded</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "schedule_id",
            "description": "<p>The session ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>File title</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/FileController.php",
    "groupTitle": "File_Upload",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/upload/user/profile-picture",
    "title": "Upload Profile Picture",
    "version": "1.0.0",
    "name": "UploadUserProfilePicture",
    "description": "<p>Allows users to upload/change profile picture</p>",
    "group": "File_Upload",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "File",
            "allowedValues": [
              "*.jpeg",
              "*.bmp",
              "*.png",
              "*.gif"
            ],
            "optional": false,
            "field": "profile_picture",
            "description": "<p>The file to be uploaded</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>public URL of the profile picture</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"url\": \"https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/jMoBdeY7IlWlqgKOHfmdnC6fls6iUiQjMYcjgEmK.jpeg\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/FileController.php",
    "groupTitle": "File_Upload",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "delete",
    "url": "<HOST>/api/school-grading-category/remove/:id",
    "title": "Delete School Grading Category",
    "version": "1.0.0",
    "name": "DeleteSchoolGradingCategory",
    "description": "<p>Deletes the School Grading Category</p>",
    "group": "Grading_Category",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of school grading category to delete</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/Api/SchoolGradingCategoryController.php",
    "groupTitle": "Grading_Category",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "delete",
    "url": "<HOST>/api/subject-grading-category/remove/:id",
    "title": "Delete Subject Grading Category",
    "version": "1.0.0",
    "name": "DeleteSubjectGradingCategory",
    "description": "<p>Deletes the Subject Grading Category</p>",
    "group": "Grading_Category",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of Subject grading category to delete</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/Api/SubjectGradingCategoryController.php",
    "groupTitle": "Grading_Category",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/school-grading-categories",
    "title": "Get School Grading Categories",
    "version": "1.0.0",
    "name": "GetSchoolGradingCategory",
    "description": "<p>Gets the grading categories the school of the logged in user.</p>",
    "group": "Grading_Category",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>School Grading Category ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "school_id",
            "description": "<p>ID of the school that uses the category. Taken from user's school ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "category",
            "description": "<p>name of the grading category</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "category_percentage",
            "description": "<p>grading category percentage (between 0 - 1)</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 1,\n        \"school_id\": 1,\n        \"category\": \"Periodical Exam\",\n        \"category_percentage\": \"0.3\"\n    },\n    {\n        \"id\": 2,\n        \"school_id\": 1,\n        \"category\": \"Written Works\",\n        \"category_percentage\": \"0.2\"\n    },\n    {\n        \"id\": 3,\n        \"school_id\": 1,\n        \"category\": \"Participation\",\n        \"category_percentage\": \"0.4\"\n    },\n    {\n        \"id\": 4,\n        \"school_id\": 1,\n        \"category\": \"Performance\",\n        \"category_percentage\": \"0.1\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/SchoolGradingCategoryController.php",
    "groupTitle": "Grading_Category",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/subject-grading-categories/:id",
    "title": "Get Subject Grading Categories",
    "version": "1.0.0",
    "name": "GetSubjectGradingCategories",
    "description": "<p>Gets the grading categories a subject specified in {id}.</p>",
    "group": "Grading_Category",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the Subject ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Subject Grading Category ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject_id",
            "description": "<p>Subject ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "category_id",
            "description": "<p>School Grading Category ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "category_percentage",
            "description": "<p>subject grading category percentage (between 0 - 1)</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 1,\n        \"subject_id\": 1,\n        \"category_id\": \"1\",\n        \"category_percentage\": \"0.25\"\n    },\n    {\n        \"id\": 2,\n        \"subject_id\": 1,\n        \"category_id\": \"2\",\n        \"category_percentage\": \"0.25\"\n    },\n    {\n        \"id\": 4,\n        \"subject_id\": 1,\n        \"category_id\": \"4\",\n        \"category_percentage\": \"0.2\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/SubjectGradingCategoryController.php",
    "groupTitle": "Grading_Category",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/school-grading-category/save",
    "title": "Add/Edit School Grading Category",
    "version": "1.0.0",
    "name": "SaveSchoolGradingCategory",
    "description": "<p>Saves School Grading Category</p>",
    "group": "Grading_Category",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the School Grading Category ID. If not supplied, adds new category, otherwise updates the supplied ID.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "category",
            "description": "<p>Name of the grading category. Required when creating a new category.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "category_percentage",
            "description": "<p>Category Percentage between 0 and 1. Required when creating a new category.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>School Grading Category ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "school_id",
            "description": "<p>ID of the school that uses the category. Taken from user's school ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "category",
            "description": "<p>name of the grading category</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "category_percentage",
            "description": "<p>grading category percentage (between 0 - 1)</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 6,\n    \"school_id\": 1,\n    \"category\": \"Performance Test\",\n    \"category_percentage\": 0.1\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/SchoolGradingCategoryController.php",
    "groupTitle": "Grading_Category",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/subject-grading-category/save",
    "title": "Add/Edit Subject Grading Category",
    "version": "1.0.0",
    "name": "SaveSubjectGradingCategory",
    "description": "<p>Saves Subject Grading Category</p>",
    "group": "Grading_Category",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the Subject Grading Category ID. If not supplied, adds new category, otherwise updates the supplied ID.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "category_id",
            "description": "<p>ID of the School Grading Category. Required when creating a new category.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "subject",
            "description": "<p>ID of the Subject. Required when creating a new category.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "category_percentage",
            "description": "<p>Category Percentage between 0 and 1. Required when creating a new category.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Subject Grading Category ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject_id",
            "description": "<p>Subject ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category_id",
            "description": "<p>School Grading Category ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category_percentage",
            "description": "<p>subject grading category percentage (between 0 - 1)</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 4,\n    \"subject_id\": 1,\n    \"category_id\": 4,\n    \"category_percentage\": 0.2\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/SubjectGradingCategoryController.php",
    "groupTitle": "Grading_Category",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/class/lesson-plan/mark-done/:id",
    "title": "Lesson Plan Mark Done",
    "version": "1.0.0",
    "name": "LessonPlanMarkDone",
    "description": "<p>Marks Lesson Plan as Done</p>",
    "group": "Lesson_Plan",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of lesson plan</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/LessonPlanController.php",
    "groupTitle": "Lesson_Plan",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/class/lesson-plan/mark-not-done/:id",
    "title": "Lesson Plan Mark Not Done",
    "version": "1.0.0",
    "name": "LessonPlanMarkNotDone",
    "description": "<p>Marks Lesson Plan as Not Done</p>",
    "group": "Lesson_Plan",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of lesson plan</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/LessonPlanController.php",
    "groupTitle": "Lesson_Plan",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/class/lesson-plan/save",
    "title": "Add/Edit Lesson Plan",
    "version": "1.0.0",
    "name": "SaveLessonPlan",
    "description": "<p>Saves lesson plan URL and title</p>",
    "group": "Lesson_Plan",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "schedule_id",
            "description": "<p>the schedule ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>web link of the lesson plan.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>Title of the lesson plan.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>the Class ID.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Lesson Plan ID; If given, API will update the lesson plan ID, otherwise, will add new lesson plan.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "lessonPlans.id",
            "description": "<p>the Lesson Plan ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "lessonPlans.title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "lessonPlans.uploaded_file",
            "description": "<p>link to uploaded file or</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "lessonPlans.resource_link",
            "description": "<p>a shared reference link (google docs, etc)</p>"
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "lessonPlans.done",
            "description": "<p>returns true if lesson plan has been marked as done, otherwise, false</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "added_by",
            "description": "<p>the teacher/user who added this lesson plan</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "added_by.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.last_name",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "        {\n\t\t\t\"id\": 2,\n\t\t\t\"title\": \"Hello Lesson Plan\",\n\t\t\t\"uploaded_file\": \"\",\n\t\t\t\"resource_link\": \"http://sample-lessson-plan-link.com\",\n\t\t\t\"added_by\": {\n\t\t\t\t\"id\": 9,\n\t\t\t\t\"first_name\": \"teacher jayson\",\n\t\t\t\t\"last_name\": \"barino\"\n\t\t\t}\n\t\t}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/LessonPlanController.php",
    "groupTitle": "Lesson_Plan",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/periodical/save",
    "title": "Add/Edit Periodical",
    "version": "1.0.0",
    "name": "AddPeriodical",
    "description": "<p>Saves a new periodical with attached questionnaires</p>",
    "group": "Periodicals",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": true,
            "field": "activity_id",
            "description": "<p>if provided, edits the existing record</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "questionnaires"
            ],
            "optional": true,
            "field": "include",
            "description": "<p>if specified, includes the questionnaire details in response data</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>the periodical title</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "instruction",
            "description": "<p>descriptions/instructions/introduction texts</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "duration",
            "description": "<p>time limit on answering this class</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "category_id",
            "description": "<p>to which category this periodical should be: written, performance, etc (whatever is defined by the school)</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "subject_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>array of questionnaire IDs attached to the periodical</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.id",
            "description": "<p>questionnaire ID attached by teacher</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of newly created periodical</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "instruction",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "duration",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activity_availability_status",
            "description": "<p>OPEN by default</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "subject",
            "description": "<p>subject details</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.subject_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "category",
            "description": "<p>the category details</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category.school_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "category.category",
            "description": "<p>the category title</p>"
          },
          {
            "group": "Success 200",
            "type": "Float",
            "optional": false,
            "field": "category.category_percentage",
            "description": "<p>the weight of the category in overall grade calculation</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>refer to <a href='#api-Questionnaire-QuestionnaireDetail'><font color='blue'><HOST>/api/questionnaire/:id</font></a> for the questionnaire details</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"id\": 21,\n\t\"title\": \"Periodical - written\",\n\t\"instruction\": \"answer this\",\n\t\"duration\": 60,\n\t\"activity_availability_status\": \"OPEN\",\n\t\"subject\": {\n\t\t\"id\": 2,\n\t\t\"subject_name\": \"Filipino\"\n\t},\n\t\"category\": {\n\t\t\"id\": 1,\n\t\t\"school_id\": 1,\n\t\t\"category\": \"Written Works\",\n\t\t\"category_percentage\": \"0.3\"\n\t},\n\t\"questionnaires\": [\n\t\t{\n\t\t\t\"id\": 2,\n\t\t\t\"title\": \"Questionnaire 1\",\n\t\t\t\"intro\": \"this is a quiz to answer\",\n\t\t\t\"subject_id\": 1,\n\t\t\t\"school_published\": 0,\n\t\t\t\"school_published_date\": null,\n\t\t\t\"author\": {\n\t\t\t\t\"id\": 8,\n\t\t\t\t\"first_name\": \"teacher tom\",\n\t\t\t\t\"last_name\": \"cruz\"\n\t\t\t},\n\t\t\t\"questions\": [\n\t\t\t\t{\n\t\t\t\t\t\"id\": 3,\n\t\t\t\t\t\"question\": \"test\",\n\t\t\t\t\t\"question_type\": \"mcq\",\n\t\t\t\t\t\"media_url\": \"http://sample-media.com/q1-quiz1\",\n\t\t\t\t\t\"weight\": 1,\n\t\t\t\t\t\"choices\": [\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"d\",\n\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"e\",\n\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t}\n\t\t\t\t\t]\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"id\": 4,\n\t\t\t\t\t\"question\": \"test2\",\n\t\t\t\t\t\"question_type\": \"mcq\",\n\t\t\t\t\t\"media_url\": \"http://sample-media.com/q2-quiz1\",\n\t\t\t\t\t\"weight\": 5,\n\t\t\t\t\t\"choices\": [\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t}\n\t\t\t\t\t]\n\t\t\t\t}\n\t\t\t]\n\t\t}\n\t]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Periodicals",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/periodical/questionnaire/add",
    "title": "Add Questionnaire",
    "version": "1.0.0",
    "name": "AddPeriodicalQuestionnaire",
    "description": "<p>Allows adding more questionnaires to the existing periodical</p>",
    "group": "Periodicals",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the ID of the periodical</p>"
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>array of questionnaire IDs to be added to the periodical</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.id",
            "description": "<p>the questionnaire ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Periodicals",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "delete",
    "url": "<HOST>/api/periodical/delete/:id",
    "title": "Delete Periodical",
    "version": "1.0.0",
    "name": "DeletePeriodical",
    "description": "<p>Delete the periodical from the periodical bank</p>",
    "group": "Periodicals",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Periodicals",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/periodicals",
    "title": "Get Periodicals",
    "version": "1.0.0",
    "name": "ListPeriodicals",
    "description": "<p>Returns array of periodicals</p>",
    "group": "Periodicals",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "questionnaires"
            ],
            "optional": true,
            "field": "include",
            "description": "<p>if specified, includes the questionnaire details in response data</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>filter the list to return published periodicals to the class.<br> OPTIONAL for teacher; and if not specified, returns all the periodicals created by teacher<br><br> REQUIRED for school admin and students.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "subject_id",
            "description": "<p>filter the list to return periodiclas of the specified subject only.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "teacher_id",
            "description": "<p>required if logged in as school admin (for viewing the list of periodicals published by the specified teacher_id)</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "schedule_id",
            "description": "<p>required if class_id is provided</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "the",
            "description": "<p>periodical ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "instruction",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "duration",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activity_availability_status",
            "description": "<p>OPEN/CLOSED</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "submission_status",
            "description": "<p>available in student profile only. Values: TO DO/ONGOING/DONE</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTimeOrNull",
            "optional": false,
            "field": "submission_date",
            "description": "<p>available in student profile only</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "subject",
            "description": "<p>subject details</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.subject_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "published",
            "description": "<p>flag if quiz is published to class or not</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "category",
            "description": "<p>the category details</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category.school_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "category.category",
            "description": "<p>the category title</p>"
          },
          {
            "group": "Success 200",
            "type": "Float",
            "optional": false,
            "field": "category.category_percentage",
            "description": "<p>the weight of the category in overall grade calculation</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>refer to <a href='#api-Questionnaire-QuestionnaireDetail'><font color='blue'><HOST>/api/questionnaire/:id</font></a> for the questionnaire details</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n\t{\n\t\t\"id\": 21,\n\t\t\"title\": \"periodical - written\",\n\t\t\"instruction\": \"answer this\",\n\t\t\"duration\": 60,\n\t\t\"activity_availability_status\": \"CLOSED\",\n\t\t\"submission_status\": \"DONE\",\n\t\t\"submission_date\": \"2020-08-29 10:56:18\",\n\t\t\"subject\": {\n\t\t\t\"id\": 2,\n\t\t\t\"subject_name\": \"Filipino\"\n\t\t},\n\t\t\"category\": {\n\t\t\t\"id\": 1,\n\t\t\t\"school_id\": 1,\n\t\t\t\"category\": \"Written Works\",\n\t\t\t\"category_percentage\": \"0.3\"\n\t\t},\n\t\t\"questionnaires\": [\n\t\t\t{\n\t\t\t\t\"id\": 2,\n\t\t\t\t\"title\": \"Questionnaire 1\",\n\t\t\t\t\"intro\": \"this is a quiz to answer\",\n\t\t\t\t\"subject_id\": 1,\n\t\t\t\t\"school_published\": 0,\n\t\t\t\t\"school_published_date\": null,\n\t\t\t\t\"author\": {\n\t\t\t\t\t\"id\": 8,\n\t\t\t\t\t\"first_name\": \"teacher tom\",\n\t\t\t\t\t\"last_name\": \"cruz\"\n\t\t\t\t},\n\t\t\t\t\"questions\": [\n\t\t\t\t\t{\n\t\t\t\t\t\t\"id\": 3,\n\t\t\t\t\t\t\"question\": \"test\",\n\t\t\t\t\t\t\"question_type\": \"mcq\",\n\t\t\t\t\t\t\"media_url\": \"http://sample-media.com/q1-quiz1\",\n\t\t\t\t\t\t\"weight\": 1,\n\t\t\t\t\t\t\"choices\": [\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\"option\": \"d\",\n\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\"option\": \"e\",\n\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t}\n\t\t\t\t\t\t]\n\t\t\t\t\t},\n\t\t\t\t\t{\n\t\t\t\t\t\t\"id\": 4,\n\t\t\t\t\t\t\"question\": \"test2\",\n\t\t\t\t\t\t\"question_type\": \"mcq\",\n\t\t\t\t\t\t\"media_url\": \"http://sample-media.com/q2-quiz1\",\n\t\t\t\t\t\t\"weight\": 5,\n\t\t\t\t\t\t\"choices\": [\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t}\n\t\t\t\t\t\t]\n\t\t\t\t\t}\n\t\t\t\t]\n\t\t\t},\n\t\t\t{}\n\t\t]\n\t}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Periodicals",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/quiz/close/:id",
    "title": "Close Periodical (for Teacher)",
    "version": "1.0.0",
    "name": "PeriodicalClose",
    "description": "<p>Close the periodical to prevent the student from taking the periodical</p>",
    "group": "Periodicals",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the periodical ID</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\"success\": true}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Periodicals",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/periodical/complete/:id",
    "title": "Complete Periodical (for Student)",
    "version": "1.0.0",
    "name": "PeriodicalComplete",
    "description": "<p>Mark periodical as complete (student side)</p>",
    "group": "Periodicals",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the quiz ID</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\"success\": true}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Periodicals",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/periodical/:id",
    "title": "Get Periodical Detail",
    "version": "1.0.0",
    "name": "PeriodicalDetail",
    "description": "<p>Returns details of the specified periodical ID</p>",
    "group": "Periodicals",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "questionnaires"
            ],
            "optional": true,
            "field": "include",
            "description": "<p>if specified, includes the questionnaire details in response data</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the periodical ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "instruction",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "duration",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activity_availability_status",
            "description": "<p>OPEN/CLOSED</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "submission_status",
            "description": "<p>available in student profile only. Values: TO DO/ONGOING/DONE</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTimeOrNull",
            "optional": false,
            "field": "submission_date",
            "description": "<p>available in student profile only</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "subject",
            "description": "<p>subject details</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.subject_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "category",
            "description": "<p>the category details</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category.school_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "category.category",
            "description": "<p>the category title</p>"
          },
          {
            "group": "Success 200",
            "type": "Float",
            "optional": false,
            "field": "category.category_percentage",
            "description": "<p>the weight of the category in overall grade calculation</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>refer to <a href='#api-Questionnaire-QuestionnaireDetail'><font color='blue'><HOST>/api/questionnaire/:id</font></a> for the questionnaire details</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "\t\t{\n\t\t\t\"id\": 17,\n\t\t\t\"title\": \"quiz2 - written\",\n\t\t\t\"instruction\": \"answer this\",\n\t\t\t\"duration\": 60,\n\t\t\t\"activity_availability_status\": \"OPEN\",\n\t\t\t\"submission_status\": \"DONE\",\n    \t\t\"submission_date\": \"2020-08-29 10:56:18\",\n\t\t\t\"subject\": {\n\t\t\t\t\"id\": 1,\n\t\t\t\t\"subject_name\": \"English\"\n\t\t\t},\n\t\t\t\"category\": {\n\t\t\t\t\"id\": 1,\n\t\t\t\t\"school_id\": 1,\n\t\t\t\t\"category\": \"Written Works\",\n\t\t\t\t\"category_percentage\": \"0.3\"\n\t\t\t},\n\t\t\t\"questionnaires\": [\n\t\t\t\t{\n\t\t\t\t\t\"id\": 2,\n\t\t\t\t\t\"title\": \"Questionnaire 1\",\n\t\t\t\t\t\"intro\": \"this is a quiz to answer\",\n\t\t\t\t\t\"subject_id\": 1,\n\t\t\t\t\t\"school_published\": 0,\n\t\t\t\t\t\"school_published_date\": null,\n\t\t\t\t\t\"author\": {\n\t\t\t\t\t\t\"id\": 8,\n\t\t\t\t\t\t\"first_name\": \"teacher tom\",\n\t\t\t\t\t\t\"last_name\": \"cruz\"\n\t\t\t\t\t},\n\t\t\t\t\t\"questions\": [\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"id\": 3,\n\t\t\t\t\t\t\t\"question\": \"test\",\n\t\t\t\t\t\t\t\"question_type\": \"mcq\",\n\t\t\t\t\t\t\t\"media_url\": \"http://sample-media.com/q1-quiz1\",\n\t\t\t\t\t\t\t\"weight\": 1,\n\t\t\t\t\t\t\t\"choices\": [\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"d\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"e\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t}\n\t\t\t\t\t\t\t]\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"id\": 4,\n\t\t\t\t\t\t\t\"question\": \"test2\",\n\t\t\t\t\t\t\t\"question_type\": \"mcq\",\n\t\t\t\t\t\t\t\"media_url\": \"http://sample-media.com/q2-quiz1\",\n\t\t\t\t\t\t\t\"weight\": 5,\n\t\t\t\t\t\t\t\"choices\": [\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t\t}\n\t\t\t\t\t\t\t]\n\t\t\t\t\t\t}\n\t\t\t\t\t]\n\t\t\t\t}\n\t\t\t]\n\t\t}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Periodicals",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/periodical/publish",
    "title": "Publish Periodical",
    "version": "1.0.0",
    "name": "PublishPeriodical",
    "description": "<p>Publishes the periodical to class</p>",
    "group": "Periodicals",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the ID of the periodical to be published</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>the target class where the periodical will be published to</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "schedule_id",
            "description": "<p>which schedule the periodical should be published</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Periodicals",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/periodical/questionnaire/remove",
    "title": "Remove Questionnaire",
    "version": "1.0.0",
    "name": "RemovePeriodicalQuestionnaire",
    "description": "<p>Allows removing questionnaires to the existing periodical. Only one questionnaire can be removed at a time</p>",
    "group": "Periodicals",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the ID of the periodical</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "questionnaire_id",
            "description": "<p>the ID of the questionnaire to be removed</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Periodicals",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/periodical/answer/submit",
    "title": "Submit Periodical Questionnaire (answers)",
    "version": "1.0.0",
    "name": "SubmitPeriodical",
    "description": "<p>Allows submission of periodical answer</p>",
    "group": "Periodicals",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "activity_id",
            "description": "<p>the periodical ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "subject_id",
            "description": "<p>the subject ID</p>"
          },
          {
            "group": "Parameter",
            "type": "DateTime",
            "optional": false,
            "field": "start_time",
            "description": "<p>the time when the student starts the periodical</p>"
          },
          {
            "group": "Parameter",
            "type": "DateTime",
            "optional": false,
            "field": "end_time",
            "description": "<p>the time when the student finishes the periodical</p>"
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>the array of questionnaires with answers</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.questionnaire_id",
            "description": "<p>the ID of questionnaire</p>"
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "questionnaires.answers",
            "description": "<p>answer details and remarks</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.answers.question_id",
            "description": "<p>the question ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.answers.status",
            "description": "<p><i>PLACEHOLDER <br><br> 0: first try, 1: retried, 2:skip</i></p>"
          },
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "questionnaires.answers.is_correct",
            "description": "<p>marks if the answer is wrong/correct</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "questionnaires.answers.answer",
            "description": "<p>the actual answer string</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the periodical ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "score",
            "description": "<p>the actual score of student</p>"
          },
          {
            "group": "Success 200",
            "type": "Double",
            "optional": false,
            "field": "score_percentage",
            "description": "<p>the student's score percentage</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "perfect",
            "description": "<p>the total score of the periodical</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "duration",
            "description": "<p>student's time in answerting the periodical</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>details of students's answers</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.id",
            "description": "<p>the questionnaire ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.activity_record_id",
            "description": "<p>record ID of this attempt</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questionnaires.answers",
            "description": "<p>answer details and remarks</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.answers.id",
            "description": "<p>record ID of this answer</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.answers.question_id",
            "description": "<p>the question which this answer is for</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.answers.status",
            "description": "<p><i>PLACEHOLDER</i></p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.answers.is_correct",
            "description": "<p>answer remark</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "questionnaires.answers.answer",
            "description": "<p>the actual answer string</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 23,\n    \"score\": 6,\n    \"score_percentage\": 1,\n    \"pefect_score\": 6,\n    \"duration\": 1500,\n    \"questionnaires\": [\n        {\n            \"questionnaire_id\": 4,\n            \"activity_record_id\": 38,\n            \"answers\": [\n                {\n                    \"id\": 75,\n                    \"question_id\": 7,\n                    \"status\": 0,\n                    \"is_correct\": 1,\n                    \"answer\": \"test 3\"\n                },\n                {\n                    \"id\": 76,\n                    \"question_id\": 8,\n                    \"status\": 0,\n                    \"is_correct\": 1,\n                    \"answer\": \"test 4\"\n                }\n            ]\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityAnswerController.php",
    "groupTitle": "Periodicals",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/periodical/unpublish",
    "title": "Unpublish Periodical",
    "version": "1.0.0",
    "name": "UnpublishPeriodical",
    "description": "<p>Removes the periodical from the class</p>",
    "group": "Periodicals",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the ID of the periodical to be unpublished</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>which class the periodical will be removed from</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Periodicals",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "Delete",
    "url": "HOST/api/comment/remove/:id",
    "title": "Remove Comment",
    "version": "1.0.0",
    "name": "RemoveComment",
    "description": "<p>Remove Comment. IMPORTANT! Only the teacher or owner of the comment can do this action.</p>",
    "group": "Post",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Comment ID.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>returns true if coomment has been removed. Otherwise, returns error code 403.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/CommentController.php",
    "groupTitle": "Post"
  },
  {
    "type": "Delete",
    "url": "HOST/api/post/remove/:id",
    "title": "Remove Post",
    "version": "1.0.0",
    "name": "RemovePost",
    "description": "<p>Remove Post. IMPORTANT! Only a teacher or the owner of the post can do this action.</p>",
    "group": "Post",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Post ID.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>returns true if post has been removed. Otherwise, returns error code 403.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/PostController.php",
    "groupTitle": "Post"
  },
  {
    "type": "GET",
    "url": "HOST/api/comment/:id",
    "title": "Get details of a Comment",
    "version": "1.0.0",
    "name": "getComment",
    "description": "<p>Get detail of a comment</p>",
    "group": "Post",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of Comment</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Comment ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Text",
            "optional": false,
            "field": "body",
            "description": "<p>content of the comment</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_at",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "added_by",
            "description": "<p>owner of the post</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "added_by.id",
            "description": "<p>id of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.first_name",
            "description": "<p>first name of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.last_name",
            "description": "<p>last name of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.profile_picture",
            "description": "<p>avatar of the owner</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 51,\n    \"body\": \"This is a sample comment from Postman. Edited here.\",\n    \"created_at\": \"2020-07-13 21:04:57\",\n    \"updated_at\": \"2020-07-13 21:10:37\",\n    \"added_by\": {\n        \"id\": 7,\n        \"first_name\": \"davy\",\n        \"last_name\": \"castillo\",\n        \"profile_picture\": \"https://iskwela.net/path/to/profile/pic.jpeg\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/CommentController.php",
    "groupTitle": "Post",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "GET",
    "url": "HOST/api/post/:id?include=comments",
    "title": "Get details of a Post",
    "version": "1.0.0",
    "name": "getPost",
    "description": "<p>Get details of a post</p>",
    "group": "Post",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of Post</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "comments"
            ],
            "optional": true,
            "field": "include",
            "description": "<p>if specified, includes the comments in response data</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Post ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Text",
            "optional": false,
            "field": "body",
            "description": "<p>content of the post</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_at",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "added_by",
            "description": "<p>owner of the post</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "added_by.id",
            "description": "<p>id of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.first_name",
            "description": "<p>first name of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.last_name",
            "description": "<p>last name of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.profile_picture",
            "description": "<p>avatar of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "comments",
            "description": "<p>list of comments of this post</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "comments.id",
            "description": "<p>Comment ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Text",
            "optional": false,
            "field": "comments.body",
            "description": "<p>content of the comment</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "comments.created_at",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "comments.updated_at",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "comments.added_by",
            "description": "<p>owner of the post</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "comments.added_by.id",
            "description": "<p>id of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "comments.added_by.first_name",
            "description": "<p>first name of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "comments.added_by.last_name",
            "description": "<p>last name of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "comments.added_by.profile_picture",
            "description": "<p>avatar of the owner</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 8,\n    \"body\": \"I know?' said Alice, 'a great girl like you,' (she might well say this), 'to go on crying in this way! Stop this moment, I tell you!' But she waited for a few yards off. The Cat only grinned when it.\",\n    \"created_at\": \"1981-10-29 00:30:58\",\n    \"updated_at\": \"1981-10-29 00:30:58\",\n    \"added_by\": {\n        \"id\": 10,\n        \"first_name\": \"teacher grace\",\n        \"last_name\": \"ungui\",\n        \"profile_picture\": \"https://iskwela.net/path/to/profile/pic.jpeg\"\n    },\n    \"comments\": [\n        {\n            \"id\": 5,\n            \"body\": \"Dormouse, without considering at all for any lesson-books!' And so she went on, 'if you only walk long enough.' Alice felt that there was the White Rabbit; 'in fact, there's nothing written on the.\",\n            \"created_at\": \"1995-06-17 15:33:58\",\n            \"updated_at\": \"1995-06-17 15:33:58\",\n            \"added_by\": {\n                \"id\": 12,\n                \"first_name\": \"teacher davy\",\n                \"last_name\": \"castillo\",\n                \"profile_picture\": \"https://iskwela.net/path/to/profile/pic.jpeg\"\n            }\n        },\n        {\n            \"id\": 46,\n            \"body\": \"Mock Turtle went on planning to herself 'It's the oldest rule in the middle. Alice kept her eyes anxiously fixed on it, and fortunately was just beginning to write this down on one knee as he shook.\",\n            \"created_at\": \"1983-04-30 18:26:19\",\n            \"updated_at\": \"1983-04-30 18:26:19\",\n            \"added_by\": {\n                \"id\": 4,\n                \"first_name\": \"davy\",\n                \"last_name\": \"castillo\",\n                \"profile_picture\": \"https://iskwela.net/path/to/profile/pic.jpeg\"\n            }\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/PostController.php",
    "groupTitle": "Post",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "GET",
    "url": "HOST/api/post/:itemable_type/:id?include=comments",
    "title": "Get posts of an itemable type",
    "version": "1.0.0",
    "name": "getPostsOfAnItem",
    "description": "<p>Get posts of selected itemable type</p>",
    "group": "Post",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "class",
              "school"
            ],
            "optional": false,
            "field": "itemable_type",
            "description": "<p>Itemable type to refer the ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of an item</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "comments"
            ],
            "optional": true,
            "field": "include",
            "description": "<p>if specified, includes the comments in response data</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "posts",
            "description": "<p>list of Posts</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "posts.id",
            "description": "<p>Post ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Text",
            "optional": false,
            "field": "posts.body",
            "description": "<p>content of the post</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "posts.created_at",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "posts.updated_at",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "posts.added_by",
            "description": "<p>owner of the post</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "posts.added_by.id",
            "description": "<p>id of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "posts.added_by.first_name",
            "description": "<p>first name of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "posts.added_by.last_name",
            "description": "<p>last name of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "posts.added_by.profile_picture",
            "description": "<p>avatar of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "comments",
            "description": "<p>list of comments of this post</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "comments.id",
            "description": "<p>Comment ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Text",
            "optional": false,
            "field": "comments.body",
            "description": "<p>content of the comment</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "comments.created_at",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "comments.updated_at",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "comments.added_by",
            "description": "<p>owner of the post</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "comments.added_by.id",
            "description": "<p>id of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "comments.added_by.first_name",
            "description": "<p>first name of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "comments.added_by.last_name",
            "description": "<p>last name of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "comments.added_by.profile_picture",
            "description": "<p>avatar of the owner</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 8,\n        \"body\": \"I know?' said Alice, 'a great girl like you,' (she might well say this), 'to go on crying in this way! Stop this moment, I tell you!' But she waited for a few yards off. The Cat only grinned when it.\",\n        \"created_at\": \"1981-10-29 00:30:58\",\n        \"updated_at\": \"1981-10-29 00:30:58\",\n        \"added_by\": {\n            \"id\": 10,\n            \"first_name\": \"teacher grace\",\n            \"last_name\": \"ungui\",\n            \"profile_picture\": \"https://iskwela.net/path/to/profile/pic.jpeg\"\n        },\n        \"comments\": [\n            {\n                \"id\": 5,\n                \"body\": \"Dormouse, without considering at all for any lesson-books!' And so she went on, 'if you only walk long enough.' Alice felt that there was the White Rabbit; 'in fact, there's nothing written on the.\",\n                \"created_at\": \"1995-06-17 15:33:58\",\n                \"updated_at\": \"1995-06-17 15:33:58\",\n                \"added_by\": {\n                    \"id\": 12,\n                    \"first_name\": \"teacher davy\",\n                    \"last_name\": \"castillo\",\n                    \"profile_picture\": \"https://iskwela.net/path/to/profile/pic.jpeg\"\n                }\n            },\n            {\n                \"id\": 46,\n                \"body\": \"Mock Turtle went on planning to herself 'It's the oldest rule in the middle. Alice kept her eyes anxiously fixed on it, and fortunately was just beginning to write this down on one knee as he shook.\",\n                \"created_at\": \"1983-04-30 18:26:19\",\n                \"updated_at\": \"1983-04-30 18:26:19\",\n                \"added_by\": {\n                    \"id\": 4,\n                    \"first_name\": \"davy\",\n                    \"last_name\": \"castillo\",\n                    \"profile_picture\": \"https://iskwela.net/path/to/profile/pic.jpeg\"\n                }\n            }\n        ]\n    },\n    {\n        \"id\": 9,\n        \"body\": \"Alice. 'Why?' 'IT DOES THE BOOTS AND SHOES.' the Gryphon added 'Come, let's try the patience of an oyster!' 'I wish I hadn't mentioned Dinah!' she said to herself; 'his eyes are so VERY wide, but.\",\n        \"created_at\": \"1989-09-23 01:49:54\",\n        \"updated_at\": \"1989-09-23 01:49:54\",\n        \"added_by\": {\n            \"id\": 6,\n            \"first_name\": \"dhame\",\n            \"last_name\": \"amaya\",\n            \"profile_picture\": \"https://iskwela.net/path/to/profile/pic.jpeg\"\n        },\n        \"comments\": [\n            {\n                \"id\": 4,\n                \"body\": \"Rabbit's little white kid gloves and a crash of broken glass. 'What a curious feeling!' said Alice; 'living at the March Hare, who had been all the while, and fighting for the hedgehogs; and in.\",\n                \"created_at\": \"1982-08-30 21:37:17\",\n                \"updated_at\": \"1982-08-30 21:37:17\",\n                \"added_by\": {\n                    \"id\": 11,\n                    \"first_name\": \"teacher jen\",\n                    \"last_name\": \"amaya\",\n                    \"profile_picture\": \"https://iskwela.net/path/to/profile/pic.jpeg\"\n                }\n            }\n        ]\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/PostController.php",
    "groupTitle": "Post",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/comment/save",
    "title": "Add/Edit a Comment",
    "version": "1.0.0",
    "name": "saveComment",
    "description": "<p>Add/Edit a comment</p>",
    "group": "Post",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of Comment. If exists, updates the specified comment, otherwise, creates new.</p>"
          },
          {
            "group": "Parameter",
            "type": "Text",
            "optional": false,
            "field": "body",
            "description": "<p>Content of the comment.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "post_id",
            "description": "<p>ID of the post.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Comment ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Text",
            "optional": false,
            "field": "body",
            "description": "<p>content of the comment</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_at",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "added_by",
            "description": "<p>owner of the comment</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "added_by.id",
            "description": "<p>id of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.first_name",
            "description": "<p>first name of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.last_name",
            "description": "<p>last name of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.profile_picture",
            "description": "<p>avatar of the owner</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 51,\n    \"body\": \"This is a sample comment from Postman. Edited here.\",\n    \"created_at\": \"2020-07-13 21:04:57\",\n    \"updated_at\": \"2020-07-13 21:10:37\",\n    \"added_by\": {\n        \"id\": 7,\n        \"first_name\": \"davy\",\n        \"last_name\": \"castillo\",\n        \"profile_picture\": \"https://iskwela.net/path/to/profile/pic.jpeg\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/CommentController.php",
    "groupTitle": "Post",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/post/save",
    "title": "Add/Edit Post",
    "version": "1.0.0",
    "name": "savePost",
    "description": "<p>Add/Edit a post</p>",
    "group": "Post",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of Post. If exists, updates the specified post, otherwise, creates new.</p>"
          },
          {
            "group": "Parameter",
            "type": "Text",
            "optional": false,
            "field": "body",
            "description": "<p>Content of the post.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "class",
              "school"
            ],
            "optional": false,
            "field": "itemable_type",
            "description": "<p>The type of item the post belongs to</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "itemable_id",
            "description": "<p>ID of the item the post belongs to. E.g. class ID, school ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Post ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Text",
            "optional": false,
            "field": "body",
            "description": "<p>content of the post</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "created_at",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "updated_at",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "added_by",
            "description": "<p>owner of the post</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "added_by.id",
            "description": "<p>id of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.first_name",
            "description": "<p>first name of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.last_name",
            "description": "<p>last name of the owner</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.profile_picture",
            "description": "<p>avatar of the owner</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 11,\n    \"body\": \"This is a sample post from Postman. Edited here.\",\n    \"created_at\": \"2020-07-13 20:29:25\",\n    \"updated_at\": \"2020-07-13 20:30:20\",\n    \"added_by\": {\n        \"id\": 7,\n        \"first_name\": \"davy\",\n        \"last_name\": \"castillo\"\n        \"profile_picture\": \"https://iskwela.net/path/to/profile/pic.jpeg\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/PostController.php",
    "groupTitle": "Post",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/student/class-projects/:id",
    "title": "List Class Projects by Schedule (for student)",
    "version": "1.0.0",
    "name": "ClassProjectsStudent",
    "description": "<p>Returns list of published class projects classified by (array of)schedules</p>",
    "group": "Projects",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the class ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the schedule ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Datetime",
            "optional": false,
            "field": "from",
            "description": "<p>date/time start of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Datetime",
            "optional": false,
            "field": "to",
            "description": "<p>date/time end of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "teacher",
            "description": "<p>the teacher handling this session (could be different from the class adviser if re-assignment happens)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "teacher.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.profile_picture",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "PENDING",
              "ONGOING",
              "DONE",
              "CANCELED"
            ],
            "optional": false,
            "field": "status",
            "description": "<p>the schedule status</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "publishedProjects",
            "description": "<p>list of published projects for this schedule</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "publishedProjects.id",
            "description": "<p>the project ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedProjects.title",
            "description": "<p>the project title</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedProjects.description",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "project"
            ],
            "optional": false,
            "field": "publishedProjects.activity_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "publishedProjects.grading_category",
            "description": "<p>the category ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "publishedProjects.total_score",
            "description": "<p>the expected perfect score</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "publishedProjects.due_date",
            "description": "<p>deadline for the project to be taken</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "published"
            ],
            "optional": false,
            "field": "publishedProjects.status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "publishedProjects.done",
            "description": "<p>indicates whether the project is open or closed.</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "publishedProjects.materials",
            "description": "<p>list of materials attached to this project</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "publishedProjects.materials.id",
            "description": "<p>the material ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedProjects.materials.title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedProjects.materials.uploaded_file",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedProjects.materials.resource_link",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 2,\n        \"from\": \"2020-05-18 09:00:00\",\n        \"to\": \"2020-05-18 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\",\n            \"profile_picture\": \"https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/NuAwve8r1j20KLNde6HjFQVhxGp4Q69p0KO38wIL.jpeg\"\n        },\n        \"status\": \"PENDING\",\n        \"publishedProjects\": [\n            {\n                \"id\": 6,\n                \"title\": \"New Project Test\",\n                \"description\": \"Project description\",\n                \"activity_type\": \"project\",\n                \"grading_category\": 1,\n                \"total_score\": 100,\n                \"due_date\": \"2020-07-10 10:00:00\",\n                \"status\": \"published\",\n                \"done\": \"false\",\n                \"materials\": [\n                    {\n                        \"id\": 6,\n                        \"title\": \"Test Title 2\",\n                        \"uploaded_file\": \"\",\n                        \"resource_link\": \"sample-activity-material-link3.com\"\n                    }\n                ]\n            }\n        ]\n    },\n    {},\n    {}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ScheduleController.php",
    "groupTitle": "Projects",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/teacher/class-projects/:id",
    "title": "List Class Projects by Schedule (for teacher)",
    "version": "1.0.0",
    "name": "ClassProjectsTeacher",
    "description": "<p>Returns list of class projects classified by (array of)schedules</p>",
    "group": "Projects",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the class ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the schedule ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Datetime",
            "optional": false,
            "field": "from",
            "description": "<p>date/time start of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Datetime",
            "optional": false,
            "field": "to",
            "description": "<p>date/time end of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "teacher",
            "description": "<p>the teacher handling this session (could be different from the class adviser if re-assignment happens)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "teacher.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.profile_picture",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "PENDING",
              "ONGOING",
              "DONE",
              "CANCELED"
            ],
            "optional": false,
            "field": "status",
            "description": "<p>the schedule status</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "publishedProjects",
            "description": "<p>list of published projects for this schedule</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "publishedProjects.id",
            "description": "<p>the project ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedProjects.title",
            "description": "<p>the project title</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedProjects.description",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "project"
            ],
            "optional": false,
            "field": "publishedProjects.activity_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "publishedProjects.grading_category",
            "description": "<p>the category ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "publishedProjects.total_score",
            "description": "<p>the expected perfect score</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "publishedProjects.due_date",
            "description": "<p>deadline for the project to be taken</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "published"
            ],
            "optional": false,
            "field": "publishedProjects.status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "publishedProjects.done",
            "description": "<p>indicates whether the project is open or closed.</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "publishedProjects.materials",
            "description": "<p>list of materials attached to this project</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "publishedProjects.materials.id",
            "description": "<p>the material ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedProjects.materials.title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedProjects.materials.uploaded_file",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedProjects.materials.resource_link",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "unpublishedProjects",
            "description": "<p>list of published projects for this schedule</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "unpublishedProjects.id",
            "description": "<p>the project ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "unpublishedProjects.title",
            "description": "<p>the project title</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "unpublishedProjects.description",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "project"
            ],
            "optional": false,
            "field": "unpublishedProjects.activity_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "unpublishedProjects.grading_category",
            "description": "<p>the category ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "unpublishedProjects.total_score",
            "description": "<p>the expected perfect score</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "unpublishedProjects.due_date",
            "description": "<p>deadline for the project to be taken</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "unpublished"
            ],
            "optional": false,
            "field": "unpublishedProjects.status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "unpublishedProjects.done",
            "description": "<p>indicates whether the project is open or closed.</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "unpublishedProjects.materials",
            "description": "<p>list of materials attached to this project</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "unpublishedProjects.materials.id",
            "description": "<p>the material ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "unpublishedProjects.materials.title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "unpublishedProjects.materials.uploaded_file",
            "description": "<p>link to uploaded file</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "unpublishedProjects.materials.resource_link",
            "description": "<p>a shared reference link (google docs, etc)</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 2,\n        \"from\": \"2020-05-18 09:00:00\",\n        \"to\": \"2020-05-18 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\",\n            \"profile_picture\": \"https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/NuAwve8r1j20KLNde6HjFQVhxGp4Q69p0KO38wIL.jpeg\"\n        },\n        \"status\": \"PENDING\",\n        \"publishedProjects\": [\n            {\n                \"id\": 6,\n                \"title\": \"New Project Test\",\n                \"description\": \"Project description\",\n                \"activity_type\": \"project\",\n                \"grading_category\": 1,\n                \"total_score\": 100,\n                \"due_date\": \"2020-07-10 10:00:00\",\n                \"status\": \"published\",\n                \"done\": \"false\",\n                \"materials\": [\n                    {\n                        \"id\": 6,\n                        \"title\": \"Test Title 2\",\n                        \"uploaded_file\": \"\",\n                        \"resource_link\": \"sample-activity-material-link3.com\"\n                    }\n                ]\n            }\n        ],\n        \"unpublishedProjects\": [\n            {\n                \"id\": 3,\n                \"title\": \"New assignment Test\",\n                \"description\": \"Project description\",\n                \"activity_type\": \"project\",\n                \"grading_category\": 1,\n                \"total_score\": 100,\n                \"due_date\": \"2020-07-10 10:00:00\",\n                \"status\": \"unpublished\",\n                \"done\": \"false\",\n                \"materials\": []\n            },\n            {\n                \"id\": 8,\n                \"title\": \"New Project Test\",\n                \"description\": \"Project description\",\n                \"activity_type\": \"project\",\n                \"grading_category\": 1,\n                \"total_score\": 100,\n                \"due_date\": \"2020-07-10 10:00:00\",\n                \"status\": \"unpublished\",\n                \"done\": \"false\",\n                \"materials\": []\n            }\n        ]\n    },\n    {},\n    {}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ScheduleController.php",
    "groupTitle": "Projects",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/class/project/get-score/:id",
    "title": "Get Project Score",
    "version": "1.0.0",
    "name": "GetProjectScore",
    "description": "<p>Shows the score of student(s) of the given project ID</p>",
    "group": "Projects",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": "<p>the student ID. If not provided, displays scores of all students in the class</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>score record ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "activity_id",
            "description": "<p>the project ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "score",
            "description": "<p>achieved points</p>"
          },
          {
            "group": "Success 200",
            "type": "Double",
            "optional": false,
            "field": "score_percentage",
            "description": "<p>score rating</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "\t\t{\n            \"id\": 2,\n            \"student_id\": \"2\",\n            \"activity_id\": \"4\",\n            \"score\": \"80\",\n            \"score_percentage\": 0.8\n        }",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityScoreController.php",
    "groupTitle": "Projects",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/teacher/remove/class-project/:id",
    "title": "Delete Project",
    "version": "1.0.0",
    "name": "ProjectDelete",
    "description": "<p>Delete the project</p>",
    "group": "Projects",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of project to be deleted</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Projects",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/class/project/mark-done/:id",
    "title": "Mark Done",
    "version": "1.0.0",
    "name": "ProjectDone",
    "description": "<p>Mark project to done</p>",
    "group": "Projects",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of project to be done/closed</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Projects",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/class/project/mark-not-done/:id",
    "title": "Mark Undone",
    "version": "1.0.0",
    "name": "ProjectUndone",
    "description": "<p>Mark project to undone</p>",
    "group": "Projects",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of project to be undone/open</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Projects",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/class/project/set-score",
    "title": "Set Project Score",
    "version": "1.0.0",
    "name": "SetProjectScore",
    "description": "<p>Sets a student project score</p>",
    "group": "Projects",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "score",
            "description": "<p>score of the student</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": "<p>user ID of the student</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "activity_id",
            "description": "<p>activity ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>score record ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "activity_id",
            "description": "<p>the project ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "score",
            "description": "<p>achieved points</p>"
          },
          {
            "group": "Success 200",
            "type": "Double",
            "optional": false,
            "field": "score_percentage",
            "description": "<p>score rating</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "\t\t{\n            \"id\": 2,\n            \"student_id\": \"2\",\n            \"activity_id\": \"4\",\n            \"score\": \"80\",\n            \"score_percentage\": 0.8\n        }",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityScoreController.php",
    "groupTitle": "Projects",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/student/project-answers/:id",
    "title": "View Answers (for student)",
    "version": "1.0.0",
    "name": "ShowProjectAnswerStudent",
    "description": "<p>Show the current student's answer of the given project</p>",
    "group": "Projects",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the project ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>record ID of the answer</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "assignment_id",
            "description": "<p>the project ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "answer_media",
            "description": "<p>link to the uploaded answer</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "student",
            "description": "<p>student details who submitted the answer</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "student.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "student.last_name",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 3,\n        \"assignment_id\": 6,\n        \"answer_media\": \"http://api.schoolhub.local:8080/api/download/activity/answer/3\",\n        \"answer_text\": \"Answer Text Sample\",\n        \"student\": {\n            \"id\": 1,\n            \"first_name\": \"jayson\",\n            \"last_name\": \"barino\"\n        }\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentAnswerController.php",
    "groupTitle": "Projects",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/teacher/project-answers/:id",
    "title": "View Answers (for teacher)",
    "version": "1.0.0",
    "name": "ShowProjectAnswerTeacher",
    "description": "<p>Show the student's answer of the given project</p>",
    "group": "Projects",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the project ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": true,
            "field": "student_id",
            "description": "<p>if supplied, returns the answer of the specific student only</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>record ID of the answer</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "assignment_id",
            "description": "<p>the project ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "answer_media",
            "description": "<p>link to the uploaded answer</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "student",
            "description": "<p>student details who submitted the answer</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "student.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "student.last_name",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 3,\n        \"assignment_id\": 6,\n        \"answer_media\": \"http://api.schoolhub.local:8080/api/download/activity/answer/3\",\n        \"answer_text\": \"Answer Text Sample\",\n        \"student\": {\n            \"id\": 1,\n            \"first_name\": \"jayson\",\n            \"last_name\": \"barino\"\n        }\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentAnswerController.php",
    "groupTitle": "Projects",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/upload/project/answer",
    "title": "Upload Answer (For student)",
    "version": "1.0.0",
    "name": "UploadProjectAnswer",
    "description": "<p>Upload project answer</p>",
    "group": "Projects",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "File",
            "allowedValues": [
              "*.jpeg",
              "*.bmp",
              "*.png",
              "*.gif",
              "*.pdf",
              "*.doc",
              "*.txt"
            ],
            "optional": false,
            "field": "file",
            "description": "<p>The file to be uploaded</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "assignment_id",
            "description": "<p>the activity id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "answer_text",
            "description": "<p>free text answer</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/FileController.php",
    "groupTitle": "Projects",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/upload/project/material",
    "title": "Add Material (FILE)",
    "version": "1.0.0",
    "name": "UploadProjectMaterial",
    "description": "<p>Upload project material/resource for student's reference</p>",
    "group": "Projects",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "File",
            "allowedValues": [
              "*.jpeg",
              "*.bmp",
              "*.png",
              "*.gif",
              "*.pdf",
              "*.doc",
              "*.txt"
            ],
            "optional": false,
            "field": "file",
            "description": "<p>The file to be uploaded</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "assignment_id",
            "description": "<p>the activity id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>file title</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/FileController.php",
    "groupTitle": "Projects",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/class/project/save",
    "title": "Add/Edit Project",
    "version": "1.0.0",
    "name": "addProject",
    "description": "<p>Add new project</p>",
    "group": "Projects",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>title of project</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "DateTime",
            "optional": false,
            "field": "due_date",
            "description": "<p>deadline of project to be submitted</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "published",
            "description": "<p>0: not published, 1:published</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "subject_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "schedule_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "total_score",
            "description": "<p>the expected perfect score for this project</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "grading_category",
            "description": "<p>the grading category ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of the created project</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "project"
            ],
            "optional": false,
            "field": "activity_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "grading_category",
            "description": "<p>the grading category ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "total_score",
            "description": "<p>the expected perfect score for this project</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "due_date",
            "description": "<p>deadline of project to be submitted</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "unpublished",
              "published"
            ],
            "optional": false,
            "field": "status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "done",
            "description": "<p>indicates if project is closed/open for takes</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "materials",
            "description": "<p>array of materials attached to the assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "materials.id",
            "description": "<p>material ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.title",
            "description": "<p>material title</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.uploaded_file",
            "description": "<p>link to uploaded file if any</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.resource_link",
            "description": "<p>URL link to resource</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 7,\n    \"title\": \"Cross Stitch\",\n    \"description\": \"Create a beautiful cross stitch.\",\n    \"activity_type\": \"project\",\n    \"grading_category\": 1,\n    \"total_score\": 50,\n    \"due_date\": \"2020-07-10 10:00:00\",\n    \"status\": \"unpublished\",\n    \"done\": \"false\",\n    \"materials\": [\n        {\n            \"id\": 4,\n            \"title\": \"Test assignment 2\",\n            \"uploaded_file\": \"\",\n            \"resource_link\": \"sample-activity-material-link3.com\"\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Projects",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/class/project-material/save",
    "title": "Add/Edit Material (URL)",
    "version": "1.0.0",
    "name": "addProjectMaterialUrl",
    "description": "<p>Add a link to projects's material</p>",
    "group": "Projects",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": true,
            "field": "id",
            "description": "<p>if supplied, edits the existing material</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "activity_id",
            "description": "<p>ID of project</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>link to resource</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the ID of added material</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "uploaded_file",
            "description": "<p>link to uploaded file if any</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "resource_link",
            "description": "<p>URL to resource</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 7,\n    \"title\": \"Test Title 2\",\n    \"uploaded_file\": \"\",\n    \"resource_link\": \"sample-activity-material-link3.com\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Projects",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/class/project/publish/:id",
    "title": "Publish Project",
    "version": "1.0.0",
    "name": "publishProject",
    "description": "<p>Publish project to be available for students</p>",
    "group": "Projects",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of project to be published</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Projects",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/teacher/remove/class-project-material/:id",
    "title": "Delete Project Material",
    "version": "1.0.0",
    "name": "removeProjectMaterial",
    "description": "<p>Remove attached material from the project</p>",
    "group": "Projects",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the project ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Projects",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "HOST/api/class/project/:id",
    "title": "Project Details",
    "version": "1.0.0",
    "name": "showProject",
    "description": "<p>Show project details</p>",
    "group": "Projects",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of project to be viewed</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Projects",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of the created project</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "project"
            ],
            "optional": false,
            "field": "activity_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "grading_category",
            "description": "<p>the grading category ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "total_score",
            "description": "<p>the expected perfect score for this project</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "due_date",
            "description": "<p>deadline of project to be submitted</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "unpublished",
              "published"
            ],
            "optional": false,
            "field": "status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "done",
            "description": "<p>indicates if project is closed/open for takes</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "materials",
            "description": "<p>array of materials attached to the assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "materials.id",
            "description": "<p>material ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.title",
            "description": "<p>material title</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.uploaded_file",
            "description": "<p>link to uploaded file if any</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.resource_link",
            "description": "<p>URL link to resource</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 6,\n    \"title\": \"New Project Test\",\n    \"description\": \"Project description\",\n    \"activity_type\": \"Project\",\n    \"grading_category\": 1,\n    \"total_score\": 100,\n    \"due_date\": \"2020-07-10 10:00:00\",\n    \"status\": \"unpublished\",\n    \"done\": \"false\",\n    \"materials\": [\n        {\n            \"id\": 4,\n            \"title\": \"Test project 2\",\n            \"uploaded_file\": \"\",\n            \"resource_link\": \"sample-activity-material-link3.com\"\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "delete",
    "url": "<HOST>/api/questionnaire/delete/:id",
    "title": "Delete Questionnaire",
    "version": "1.0.0",
    "name": "DeleteQuestionnaire",
    "description": "<p>Deletes the questionnaire</p>",
    "group": "Questionnaire",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of questionnaire to delete</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/Api/QuestionnaireController.php",
    "groupTitle": "Questionnaire",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/questionnaire/:id",
    "title": "Get Questionnaire Detail",
    "version": "1.0.0",
    "name": "QuestionnaireDetail",
    "description": "<p>Returns questionnaire detail</p>",
    "group": "Questionnaire",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>questionnaire ID</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/Api/QuestionnaireController.php",
    "groupTitle": "Questionnaire",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of the added questionnaire</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>Questionnaire title</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "intro",
            "description": "<p>Questionnaire intro/instruction</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "school_published",
            "description": "<p>0: not published to school, 1: published to school</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "school_published_date",
            "description": "<p>published date or NULL</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "author",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "author.id",
            "description": "<p>creator ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "author.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "author.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questions",
            "description": "<p>array of question object</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questions.id",
            "description": "<p>ID of the added question</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "questions.question",
            "description": "<p>the question text</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "mcq"
            ],
            "optional": false,
            "field": "questions.question_type",
            "description": "<p>accepts multiple choice for now</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questions.weight",
            "description": "<p>the score of the question</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questions.choices",
            "description": "<p>array of question choices (up to 5 choices for now)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questions.choices.option",
            "description": "<p>the choice text</p>"
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "questions.choices.is_correct",
            "description": "<p>multiple choices can be marked as correct</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "media_url",
            "description": "<p>link to attachment</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"id\": 6,\n\t\"title\": \"Questionnaire 2\",\n\t\"intro\": \"this is a questionnaire to answer\",\n\t\"subject_id\": 1,\n\t\"school_published\": 1,\n\t\"school_published_date\": null,\n\t\"author\": {\n\t\t\"id\": 9,\n\t\t\"first_name\": \"teacher jayson\",\n\t\t\"last_name\": \"barino\"\n\t},\n\t\"questions\": [\n\t\t{\n\t\t\t\"id\": 13,\n\t\t\t\"question\": \"test\",\n\t\t\t\"question_type\": \"mcq\",\n\t\t\t\"media_url\": \"http://sample-media.com/q1-questionnaire1\",\n\t\t\t\"weight\": 1,\n\t\t\t\"choices\": [\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"d\",\n\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"e\",\n\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t}\n\t\t\t]\n\t\t},\n\t\t{\n\t\t\t\"id\": 14,\n\t\t\t\"question\": \"test2\",\n\t\t\t\"question_type\": \"mcq\",\n\t\t\t\"media_url\": \"http://sample-media.com/q2-questionnaire1\",\n\t\t\t\"weight\": 5,\n\t\t\t\"choices\": [\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t}\n\t\t\t]\n\t\t}\n\t]\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/questionnaires",
    "title": "Questionnaire list",
    "version": "1.0.0",
    "name": "QuestionnaireList",
    "description": "<p>Get questionnaire list</p>",
    "group": "Questionnaire",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Array",
            "allowedValues": [
              "myQnrs",
              "schoolQnrs"
            ],
            "optional": false,
            "field": "types",
            "description": "<p>available questionnaire types. <ul><li>myQnrs: questionnaires created by logged in teacher</li><li>schoolQnrs: questionnaires published by different teachers to the school</li></ul></p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>get questionnaires of the specified class. If this is passed, the &quot;types&quot; param will be invalidated</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "limit",
            "description": "<p>number of rows returned per request. Default: 20, Max: 100</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "offset",
            "description": "<p>the offset. Min: 0</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/Api/QuestionnaireController.php",
    "groupTitle": "Questionnaire",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of the added questionnaire</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>Questionnaire title</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "intro",
            "description": "<p>Questionnaire intro/instruction</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "school_published",
            "description": "<p>0: not published to school, 1: published to school</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "school_published_date",
            "description": "<p>published date or NULL</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "author",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "author.id",
            "description": "<p>creator ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "author.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "author.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questions",
            "description": "<p>array of question object</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questions.id",
            "description": "<p>ID of the added question</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "questions.question",
            "description": "<p>the question text</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "mcq"
            ],
            "optional": false,
            "field": "questions.question_type",
            "description": "<p>accepts multiple choice for now</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questions.weight",
            "description": "<p>the score of the question</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questions.choices",
            "description": "<p>array of question choices (up to 5 choices for now)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questions.choices.option",
            "description": "<p>the choice text</p>"
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "questions.choices.is_correct",
            "description": "<p>multiple choices can be marked as correct</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "media_url",
            "description": "<p>link to attachment</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"id\": 6,\n\t\"title\": \"Questionnaire 2\",\n\t\"intro\": \"this is a questionnaire to answer\",\n\t\"subject_id\": 1,\n\t\"school_published\": 1,\n\t\"school_published_date\": null,\n\t\"author\": {\n\t\t\"id\": 9,\n\t\t\"first_name\": \"teacher jayson\",\n\t\t\"last_name\": \"barino\"\n\t},\n\t\"questions\": [\n\t\t{\n\t\t\t\"id\": 13,\n\t\t\t\"question\": \"test\",\n\t\t\t\"question_type\": \"mcq\",\n\t\t\t\"media_url\": \"http://sample-media.com/q1-questionnaire1\",\n\t\t\t\"weight\": 1,\n\t\t\t\"choices\": [\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"d\",\n\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"e\",\n\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t}\n\t\t\t]\n\t\t},\n\t\t{\n\t\t\t\"id\": 14,\n\t\t\t\"question\": \"test2\",\n\t\t\t\"question_type\": \"mcq\",\n\t\t\t\"media_url\": \"http://sample-media.com/q2-questionnaire1\",\n\t\t\t\"weight\": 5,\n\t\t\t\"choices\": [\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t}\n\t\t\t]\n\t\t}\n\t]\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/questionnaire/school-publish/:id",
    "title": "Publish Questionnaire to School",
    "version": "1.0.0",
    "name": "QuestionnaireSchoolPublish",
    "description": "<p>Publish the questionnaire to the school</p>",
    "group": "Questionnaire",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of questionnaire to publish</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/Api/QuestionnaireController.php",
    "groupTitle": "Questionnaire",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/questionnaire/save",
    "title": "Save Questionnaire",
    "version": "1.0.0",
    "name": "SaveQuestionnaire",
    "description": "<p>Save Questionnaire</p>",
    "group": "Questionnaire",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>Questionnaire title</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": true,
            "field": "questionnaire_id",
            "description": "<p>if supplied, edits the existing questionnaire</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "intro",
            "description": "<p>Questionnaire intro/instruction</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "subject_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "questions",
            "description": "<p>array of question object</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": true,
            "field": "questions.question_id",
            "description": "<p>if supplied, edits the current question</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "questions.question",
            "description": "<p>the question text</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "mcq"
            ],
            "optional": false,
            "field": "questions.question_type",
            "description": "<p>accepts multiple choice for now</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "questions.weight",
            "description": "<p>the score of the question</p>"
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "questions.choices",
            "description": "<p>array of question choices (up to 5 choices for now)</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "questions.choices.option",
            "description": "<p>the choice text</p>"
          },
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "questions.choices.is_correct",
            "description": "<p>multiple choices can be marked as correct</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "media_url",
            "description": "<p>link to attachment</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of the added Questionnaire</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>Questionnaire title</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "intro",
            "description": "<p>Questionnaire intro/instruction</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questions",
            "description": "<p>array of question object</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questions.id",
            "description": "<p>ID of the added question</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "questions.question",
            "description": "<p>the question text</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "mcq"
            ],
            "optional": false,
            "field": "questions.question_type",
            "description": "<p>accepts multiple choice for now</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questions.weight",
            "description": "<p>the score of the question</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questions.choices",
            "description": "<p>array of question choices (up to 5 choices for now)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questions.choices.option",
            "description": "<p>the choice text</p>"
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "questions.choices.is_correct",
            "description": "<p>multiple choices can be marked as correct</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "media_url",
            "description": "<p>link to attachment</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"id\": 109,\n\t\"title\": \"Questionnaire 1\",\n\t\"intro\": \"this is a Questionnaire to answer\",\n\t\"subject_id\": 1,\n\t\"questions\": [\n\t\t{\n\t\t\t\"id\": 199,\n\t\t\t\"question\": \"test\",\n\t\t\t\"question_type\": \"mcq\",\n\t\t\t\"media_url\": \"http://sample-media.com/q1-Questionnaire1\",\n\t\t\t\"weight\": 1,\n\t\t\t\"choices\": [\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\"is_correct\": true\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\"is_correct\": false\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\"is_correct\": false\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"d\",\n\t\t\t\t\t\"is_correct\": false\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"option\": \"e\",\n\t\t\t\t\t\"is_correct\": false\n\t\t\t\t}\n\t\t\t]\n\t\t},\n\t\t{},\n\t\t{}\n\t]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/QuestionnaireController.php",
    "groupTitle": "Questionnaire",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/quiz/save",
    "title": "Add/Edit Quiz",
    "version": "1.0.0",
    "name": "AddQuiz",
    "description": "<p>Saves a new quiz with attached questionnaires</p>",
    "group": "Quizzes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": true,
            "field": "activity_id",
            "description": "<p>if provided, edits the existing record</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "questionnaires"
            ],
            "optional": true,
            "field": "include",
            "description": "<p>if specified, includes the questionnaire details in response data</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>the quiz title</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "instruction",
            "description": "<p>descriptions/instructions/introduction texts</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "duration",
            "description": "<p>time limit on answering this class</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "category_id",
            "description": "<p>to which category this quiz should be: written, performance, etc (whatever is defined by the school)</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "subject_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>array of questionnaire IDs attached to the quiz</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.id",
            "description": "<p>questionnaire ID attached by teacher</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of newly created quiz</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "instruction",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "duration",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activity_availability_status",
            "description": "<p>OPEN by default</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "subject",
            "description": "<p>subject details</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.subject_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "category",
            "description": "<p>the category details</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category.school_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "category.category",
            "description": "<p>the category title</p>"
          },
          {
            "group": "Success 200",
            "type": "Float",
            "optional": false,
            "field": "category.category_percentage",
            "description": "<p>the weight of the category in overall grade calculation</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>refer to <a href='#api-Questionnaire-QuestionnaireDetail'><font color='blue'><HOST>/api/questionnaire/:id</font></a> for the questionnaire details</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"id\": 21,\n\t\"title\": \"quiz3 - written\",\n\t\"instruction\": \"answer this\",\n\t\"duration\": 60,\n\t\"subject\": {\n\t\t\"id\": 2,\n\t\t\"subject_name\": \"Filipino\"\n\t},\n\t\"activity_availability_status\": \"OPEN\",\n\t\"category\": {\n\t\t\"id\": 1,\n\t\t\"school_id\": 1,\n\t\t\"category\": \"Written Works\",\n\t\t\"category_percentage\": \"0.3\"\n\t},\n\t\"questionnaires\": [\n\t\t{\n\t\t\t\"id\": 2,\n\t\t\t\"title\": \"Questionnaire 1\",\n\t\t\t\"intro\": \"this is a quiz to answer\",\n\t\t\t\"subject_id\": 1,\n\t\t\t\"school_published\": 0,\n\t\t\t\"school_published_date\": null,\n\t\t\t\"author\": {\n\t\t\t\t\"id\": 8,\n\t\t\t\t\"first_name\": \"teacher tom\",\n\t\t\t\t\"last_name\": \"cruz\"\n\t\t\t},\n\t\t\t\"questions\": [\n\t\t\t\t{\n\t\t\t\t\t\"id\": 3,\n\t\t\t\t\t\"question\": \"test\",\n\t\t\t\t\t\"question_type\": \"mcq\",\n\t\t\t\t\t\"media_url\": \"http://sample-media.com/q1-quiz1\",\n\t\t\t\t\t\"weight\": 1,\n\t\t\t\t\t\"choices\": [\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"d\",\n\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"e\",\n\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t}\n\t\t\t\t\t]\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"id\": 4,\n\t\t\t\t\t\"question\": \"test2\",\n\t\t\t\t\t\"question_type\": \"mcq\",\n\t\t\t\t\t\"media_url\": \"http://sample-media.com/q2-quiz1\",\n\t\t\t\t\t\"weight\": 5,\n\t\t\t\t\t\"choices\": [\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t}\n\t\t\t\t\t]\n\t\t\t\t}\n\t\t\t]\n\t\t}\n\t]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Quizzes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/quiz/questionnaire/add",
    "title": "Add Questionnaire",
    "version": "1.0.0",
    "name": "AddQuizQuestionnaire",
    "description": "<p>Allows adding more questionnaires to the existing quiz</p>",
    "group": "Quizzes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the ID of the quiz</p>"
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>array of questionnaire IDs to be added to the quiz</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.id",
            "description": "<p>the questionnaire ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Quizzes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "delete",
    "url": "<HOST>/api/quiz/delete/:id",
    "title": "Delete Quiz",
    "version": "1.0.0",
    "name": "DeleteQuiz",
    "description": "<p>Delete the quiz from the quiz bank</p>",
    "group": "Quizzes",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Quizzes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/quizzes",
    "title": "Get Quizzes",
    "version": "1.0.0",
    "name": "ListQuizzes",
    "description": "<p>Returns array of quizzes</p>",
    "group": "Quizzes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "questionnaires"
            ],
            "optional": true,
            "field": "include",
            "description": "<p>if specified, includes the questionnaire details in response data</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>filter the list to return published quizzes to the class.<br> OPTIONAL for teacher; and if not specified, returns all the quizzes created by the logged in teacher<br><br> REQUIRED for school admin andstudents.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "subject_id",
            "description": "<p>filter the list to return quizzes of the specified subject only.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "teacher_id",
            "description": "<p>required if logged in as school admin (for viewing the list of quizzes published by the specified teacher_id)</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "schedule_id",
            "description": "<p>required if class_id is provided</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the quiz ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "instruction",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "duration",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activity_availability_status",
            "description": "<p>OPEN/CLOSED</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "submission_status",
            "description": "<p>available in student profile only. Values: TO DO/ONGOING/DONE</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTimeOrNull",
            "optional": false,
            "field": "submission_date",
            "description": "<p>available in student profile only</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "subject",
            "description": "<p>subject details</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.subject_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "published",
            "description": "<p>flag if quiz is published to class or not</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "category",
            "description": "<p>the category details</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category.school_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "category.category",
            "description": "<p>the category title</p>"
          },
          {
            "group": "Success 200",
            "type": "Float",
            "optional": false,
            "field": "category.category_percentage",
            "description": "<p>the weight of the category in overall grade calculation</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>refer to <a href='#api-Questionnaire-QuestionnaireDetail'><font color='blue'><HOST>/api/questionnaire/:id</font></a> for the questionnaire details</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "\t\t[\n\t\t\t{\n\t\t\t\t\"id\": 21,\n\t\t\t\t\"title\": \"quiz3 - written\",\n\t\t\t\t\"instruction\": \"answer this\",\n\t\t\t\t\"duration\": 60,\n\t\t\t\t\"activity_availability_status\": \"OPEN\",\n\t\t\t\t\"submission_status\": \"DONE\",\n    \t\t\t\"submission_date\": \"2020-08-29 10:56:18\",\n\t\t\t\t\"subject\": {\n\t\t\t\t\t\"id\": 2,\n\t\t\t\t\t\"subject_name\": \"Filipino\"\n\t\t\t\t},\n\t\t\t\t\"category\": {\n\t\t\t\t\t\"id\": 1,\n\t\t\t\t\t\"school_id\": 1,\n\t\t\t\t\t\"category\": \"Written Works\",\n\t\t\t\t\t\"category_percentage\": \"0.3\"\n\t\t\t\t},\n\t\t\t\t\"questionnaires\": [\n\t\t\t\t\t{\n\t\t\t\t\t\t\"id\": 2,\n\t\t\t\t\t\t\"title\": \"Questionnaire 1\",\n\t\t\t\t\t\t\"intro\": \"this is a quiz to answer\",\n\t\t\t\t\t\t\"subject_id\": 1,\n\t\t\t\t\t\t\"school_published\": 0,\n\t\t\t\t\t\t\"school_published_date\": null,\n\t\t\t\t\t\t\"author\": {\n\t\t\t\t\t\t\t\"id\": 8,\n\t\t\t\t\t\t\t\"first_name\": \"teacher tom\",\n\t\t\t\t\t\t\t\"last_name\": \"cruz\"\n\t\t\t\t\t\t},\n\t\t\t\t\t\t\"questions\": [\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\"id\": 3,\n\t\t\t\t\t\t\t\t\"question\": \"test\",\n\t\t\t\t\t\t\t\t\"question_type\": \"mcq\",\n\t\t\t\t\t\t\t\t\"media_url\": \"http://sample-media.com/q1-quiz1\",\n\t\t\t\t\t\t\t\t\"weight\": 1,\n\t\t\t\t\t\t\t\t\"choices\": [\n\t\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\t\"option\": \"d\",\n\t\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\t\"option\": \"e\",\n\t\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t\t}\n\t\t\t\t\t\t\t\t]\n\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\"id\": 4,\n\t\t\t\t\t\t\t\t\"question\": \"test2\",\n\t\t\t\t\t\t\t\t\"question_type\": \"mcq\",\n\t\t\t\t\t\t\t\t\"media_url\": \"http://sample-media.com/q2-quiz1\",\n\t\t\t\t\t\t\t\t\"weight\": 5,\n\t\t\t\t\t\t\t\t\"choices\": [\n\t\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t\t\t}\n\t\t\t\t\t\t\t\t]\n\t\t\t\t\t\t\t}\n\t\t\t\t\t\t]\n\t\t\t\t\t},\n\t\t\t\t\t{}\n\t\t\t\t]\n\t\t\t}\n\t\t]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Quizzes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/quiz/publish",
    "title": "Publish Quiz",
    "version": "1.0.0",
    "name": "PublishQuiz",
    "description": "<p>Publishes the quiz to class</p>",
    "group": "Quizzes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the ID of the quiz to be published</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>the target class where the quiz will be published to</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "schedule_id",
            "description": "<p>which schedule the quiz should be published</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Quizzes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/quiz/close/:id",
    "title": "Close Quiz (for Teacher)",
    "version": "1.0.0",
    "name": "QuizClose",
    "description": "<p>Close the quiz to prevent the student from taking the quiz</p>",
    "group": "Quizzes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the quiz ID</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\"success\": true}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Quizzes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/quiz/complete/:id",
    "title": "Complete Quiz (for Student)",
    "version": "1.0.0",
    "name": "QuizComplete",
    "description": "<p>Mark quiz as complete (student side)</p>",
    "group": "Quizzes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the quiz ID</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\"success\": true}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Quizzes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/quiz/:id",
    "title": "Get Quiz Detail",
    "version": "1.0.0",
    "name": "QuizDetail",
    "description": "<p>Returns details of the specified quiz ID</p>",
    "group": "Quizzes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "questionnaires"
            ],
            "optional": true,
            "field": "include",
            "description": "<p>if specified, includes the questionnaire details in response data</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the quiz ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "instruction",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "duration",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activity_availability_status",
            "description": "<p>OPEN/CLOSED</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "submission_status",
            "description": "<p>available in student profile only. Values: TO DO/ONGOING/DONE</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTimeOrNull",
            "optional": false,
            "field": "submission_date",
            "description": "<p>available in student profile only</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "subject",
            "description": "<p>subject details</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.subject_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "category",
            "description": "<p>the category details</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "category.school_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "category.category",
            "description": "<p>the category title</p>"
          },
          {
            "group": "Success 200",
            "type": "Float",
            "optional": false,
            "field": "category.category_percentage",
            "description": "<p>the weight of the category in overall grade calculation</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>refer to <a href='#api-Questionnaire-QuestionnaireDetail'><font color='blue'><HOST>/api/questionnaire/:id</font></a> for the questionnaire details</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "\t\t{\n\t\t\t\"id\": 17,\n\t\t\t\"title\": \"quiz2 - written\",\n\t\t\t\"instruction\": \"answer this\",\n\t\t\t\"duration\": 60,\n\t\t\t\"activity_availability_status\": \"OPEN\",\n\t\t\t\"submission_status\": \"DONE\",\n    \t\t\"submission_date\": \"2020-08-29 10:56:18\",\n\t\t\t\"subject\": {\n\t\t\t\t\"id\": 1,\n\t\t\t\t\"subject_name\": \"English\"\n\t\t\t},\n\t\t\t\"category\": {\n\t\t\t\t\"id\": 1,\n\t\t\t\t\"school_id\": 1,\n\t\t\t\t\"category\": \"Written Works\",\n\t\t\t\t\"category_percentage\": \"0.3\"\n\t\t\t},\n\t\t\t\"questionnaires\": [\n\t\t\t\t{\n\t\t\t\t\t\"id\": 2,\n\t\t\t\t\t\"title\": \"Questionnaire 1\",\n\t\t\t\t\t\"intro\": \"this is a quiz to answer\",\n\t\t\t\t\t\"subject_id\": 1,\n\t\t\t\t\t\"school_published\": 0,\n\t\t\t\t\t\"school_published_date\": null,\n\t\t\t\t\t\"author\": {\n\t\t\t\t\t\t\"id\": 8,\n\t\t\t\t\t\t\"first_name\": \"teacher tom\",\n\t\t\t\t\t\t\"last_name\": \"cruz\"\n\t\t\t\t\t},\n\t\t\t\t\t\"questions\": [\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"id\": 3,\n\t\t\t\t\t\t\t\"question\": \"test\",\n\t\t\t\t\t\t\t\"question_type\": \"mcq\",\n\t\t\t\t\t\t\t\"media_url\": \"http://sample-media.com/q1-quiz1\",\n\t\t\t\t\t\t\t\"weight\": 1,\n\t\t\t\t\t\t\t\"choices\": [\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"d\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"e\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t}\n\t\t\t\t\t\t\t]\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"id\": 4,\n\t\t\t\t\t\t\t\"question\": \"test2\",\n\t\t\t\t\t\t\t\"question_type\": \"mcq\",\n\t\t\t\t\t\t\t\"media_url\": \"http://sample-media.com/q2-quiz1\",\n\t\t\t\t\t\t\t\"weight\": 5,\n\t\t\t\t\t\t\t\"choices\": [\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t\t}\n\t\t\t\t\t\t\t]\n\t\t\t\t\t\t}\n\t\t\t\t\t]\n\t\t\t\t}\n\t\t\t]\n\t\t}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Quizzes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/quiz/questionnaire/remove",
    "title": "Remove Questionnaire",
    "version": "1.0.0",
    "name": "RemoveQuizQuestionnaire",
    "description": "<p>Allows removing questionnaires to the existing quiz. Only one questionnaire can be removed at a time</p>",
    "group": "Quizzes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the ID of the quiz</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "questionnaire_id",
            "description": "<p>the ID of the questionnaire to be removed</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Quizzes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/quiz/answer/submit",
    "title": "Submit Quiz Questionnaire (answers)",
    "version": "1.0.0",
    "name": "SubmitQuiz",
    "description": "<p>Allows submission of quiz answer</p>",
    "group": "Quizzes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "activity_id",
            "description": "<p>the quiz ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "subject_id",
            "description": "<p>the subject ID</p>"
          },
          {
            "group": "Parameter",
            "type": "DateTime",
            "optional": false,
            "field": "start_time",
            "description": "<p>the time when the student starts the quiz</p>"
          },
          {
            "group": "Parameter",
            "type": "DateTime",
            "optional": false,
            "field": "end_time",
            "description": "<p>the time when the student finishes the quiz</p>"
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>the array of questionnaires with answers</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.questionnaire_id",
            "description": "<p>the ID of questionnaire</p>"
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "questionnaires.answers",
            "description": "<p>answer details and remarks</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.answers.question_id",
            "description": "<p>the question ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.answers.status",
            "description": "<p><i>PLACEHOLDER <br><br> 0: first try, 1: retried, 2:skip</i></p>"
          },
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "questionnaires.answers.is_correct",
            "description": "<p>marks if the answer is wrong/correct</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "questionnaires.answers.answer",
            "description": "<p>the actual answer string</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the quiz ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "score",
            "description": "<p>the actual score of student</p>"
          },
          {
            "group": "Success 200",
            "type": "Double",
            "optional": false,
            "field": "score_percentage",
            "description": "<p>the student's score percentage</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "perfect",
            "description": "<p>the total score of the quiz</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "duration",
            "description": "<p>student's time in answerting the quiz</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>details of students's answers</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.id",
            "description": "<p>the questionnaire ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.activity_record_id",
            "description": "<p>record ID of this attempt</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questionnaires.answers",
            "description": "<p>answer details and remarks</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.answers.id",
            "description": "<p>record ID of this answer</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.answers.question_id",
            "description": "<p>the question which this answer is for</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.answers.status",
            "description": "<p><i>PLACEHOLDER</i></p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.answers.is_correct",
            "description": "<p>answer remark</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "questionnaires.answers.answer",
            "description": "<p>the actual answer string</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"id\": 22,\n\t\"score\": 7,\n\t\"score_percent\": 0.58,\n\t\"pefect_score\": 12,\n\t\"duration\": 1500,\n\t\"questionnaires\": [\n\t\t{\n\t\t\t\"questionnaire_id\": 2,\n\t\t\t\"activity_record_id\": 36,\n\t\t\t\"answers\": [\n\t\t\t\t{\n\t\t\t\t\t\"id\": 71,\n\t\t\t\t\t\"question_id\": 3,\n\t\t\t\t\t\"status\": 0,\n\t\t\t\t\t\"is_correct\": 1,\n\t\t\t\t\t\"answer\": \"test 3\"\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"id\": 72,\n\t\t\t\t\t\"question_id\": 4,\n\t\t\t\t\t\"status\": 0,\n\t\t\t\t\t\"is_correct\": 1,\n\t\t\t\t\t\"answer\": \"test 4\"\n\t\t\t\t}\n\t\t\t]\n\t\t},\n\t\t{\n\t\t\t\"questionnaire_id\": 3,\n\t\t\t\"activity_record_id\": 37,\n\t\t\t\"answers\": [\n\t\t\t\t{\n\t\t\t\t\t\"id\": 73,\n\t\t\t\t\t\"question_id\": 5,\n\t\t\t\t\t\"status\": 0,\n\t\t\t\t\t\"is_correct\": 1,\n\t\t\t\t\t\"answer\": \"test 5\"\n\t\t\t\t},\n\t\t\t\t{\n\t\t\t\t\t\"id\": 74,\n\t\t\t\t\t\"question_id\": 6,\n\t\t\t\t\t\"status\": 0,\n\t\t\t\t\t\"is_correct\": 0,\n\t\t\t\t\t\"answer\": \"test 6\"\n\t\t\t\t}\n\t\t\t]\n\t\t}\n\t]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityAnswerController.php",
    "groupTitle": "Quizzes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/quiz/unpublish",
    "title": "Unpublish Quiz",
    "version": "1.0.0",
    "name": "UnpublishQuiz",
    "description": "<p>Removes the quiz from the class</p>",
    "group": "Quizzes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the ID of the quiz to be unpublished</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>which class the quiz will be removed from</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "success",
            "description": "<p>true/false</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityController.php",
    "groupTitle": "Quizzes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/reports/activity-scores",
    "title": "Activity Scores",
    "version": "1.0.0",
    "name": "ActivityScores",
    "description": "<p>Get the activity scores per activity type</p>",
    "group": "Reports",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>the class ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "allowedValues": [
              "YYYY-mm-dd"
            ],
            "optional": true,
            "field": "from",
            "description": "<p>date filter; default value = class start_date</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "allowedValues": [
              "YYYY-mm-dd"
            ],
            "optional": true,
            "field": "to",
            "description": "<p>date filter; default value = class end_date</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the user's ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "scores",
            "description": "<p>the activity scores</p>"
          },
          {
            "group": "Success 200",
            "type": "Double",
            "optional": false,
            "field": "scores.quizzes",
            "description": "<p>score percentage based on the date range</p>"
          },
          {
            "group": "Success 200",
            "type": "Double",
            "optional": false,
            "field": "scores.periodicals",
            "description": "<p>score percentage based on the date range</p>"
          },
          {
            "group": "Success 200",
            "type": "Double",
            "optional": false,
            "field": "scores.assignments",
            "description": "<p>score percentage based on the date range</p>"
          },
          {
            "group": "Success 200",
            "type": "Double",
            "optional": false,
            "field": "scores.projects",
            "description": "<p>score percentage based on the date range</p>"
          },
          {
            "group": "Success 200",
            "type": "Double",
            "optional": false,
            "field": "scores.seatworks",
            "description": "<p>score percentage based on the date range</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n\t{\n\t\t\"id\": 1,\n\t\t\"username\": \"jayson\",\n\t\t\"first_name\": \"jayson\",\n\t\t\"last_name\": \"barino\",\n\t\t\"scores\": {\n\t\t\t\"quizzes\": 0.583,\n\t\t\t\"periodicals\": 1,\n\t\t\t\"assignments\": 0.583\n\t\t\t\"project\": 0\n\t\t\t\"seatwork\": 0\n\t\t}\n\t},\n\t{},\n\t{},\n\t{}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ReportController.php",
    "groupTitle": "Reports",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/students/improvement/save",
    "title": "Add/Edit Student Improvement",
    "version": "1.0.0",
    "name": "AddEditStudentImprovement",
    "description": "<p>Add or edit student improvement</p>",
    "group": "Reports",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": "<p>Student ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>Class ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "improvement",
            "description": "<p>Improvement notes</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>student improvement ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>Class ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "class_name",
            "description": "<p>Name of Class</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": "<p>Student ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "student_first_name",
            "description": "<p>First name of student</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "student_last_name",
            "description": "<p>Last name of student</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "improvement",
            "description": "<p>Improvement notes</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n\t\"class_id\": 4,\n\t\"class_name\": \"MAPEH 201\",\n\t\"student_id\": 7,\n\t\"student_first_name\": \"vhen\",\n\t\"student_last_name\": \"fernandez\",\n\t\"improvement\": \"testing improvement\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentController.php",
    "groupTitle": "Reports",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/reports/assignments",
    "title": "Assignment Scores",
    "version": "1.0.0",
    "name": "AssignmentsScores",
    "description": "<p>Returns scores of individual assignments</p>",
    "group": "Reports",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>the class ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "user_id",
            "description": "<p>the user ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "allowedValues": [
              "YYYY-mm-dd"
            ],
            "optional": true,
            "field": "from",
            "description": "<p>date filter; default value = class start_date</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "allowedValues": [
              "YYYY-mm-dd"
            ],
            "optional": true,
            "field": "to",
            "description": "<p>date filter; default value = class end_date</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the user's ID</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "published_at",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "perfect_score",
            "description": "<p>the expected total score of the assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student_score",
            "description": "<p>the score achieved by the student</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "rating",
            "description": "<p>the percentage rate</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n\t{\n\t\t\"id\": 24,\n\t\t\"published_at\": \"2020-07-12 18:04:05\",\n\t\t\"title\": \"assignment1 - written\",\n\t\t\"perfect_score\": \"12\",\n\t\t\"student_score\": 0,\n\t\t\"rating\": 0\n\t}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ReportController.php",
    "groupTitle": "Reports",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "HOST/api/class/attendance/:id",
    "title": "Attendance Report",
    "version": "1.0.0",
    "name": "ClassAttendance",
    "description": "<p>Returns the attendance report of all users in the class</p>",
    "group": "Reports",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the class ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>the class ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "class_attendance_count",
            "description": "<p>the &quot;perfect&quot; attendance of the class</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "students",
            "description": "<p>list of students with attendance info</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "students.id",
            "description": "<p>the student ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "students.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "students.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "students.attendance",
            "description": "<p>user attendance count</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "students.absence",
            "description": "<p>user absence count</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"class_id\": 1,\n    \"class_attendance_count\": 3,\n    \"students\": [\n        {\n            \"id\": 1,\n            \"first_name\": \"jayson\",\n            \"last_name\": \"barino\",\n            \"attendance\": 3,\n            \"absence\": 0\n        },\n        {\n            \"id\": 2,\n            \"first_name\": \"grace\",\n            \"last_name\": \"ungui\",\n            \"attendance\": 3,\n            \"absence\": 0\n        },\n        {\n            \"id\": 3,\n            \"first_name\": \"jen\",\n            \"last_name\": \"castillo\",\n            \"attendance\": 2,\n            \"absence\": 1\n        },\n        {\n            \"id\": 4,\n            \"first_name\": \"davy\",\n            \"last_name\": \"castillo\",\n            \"attendance\": 2,\n            \"absence\": 1\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AttendanceController.php",
    "groupTitle": "Reports"
  },
  {
    "type": "get",
    "url": "<HOST>/api/reports/periodicals",
    "title": "Periodical Scores",
    "version": "1.0.0",
    "name": "PeriodicalScores",
    "description": "<p>Returns scores of individual periodical exams</p>",
    "group": "Reports",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>the class ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "user_id",
            "description": "<p>the user ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "allowedValues": [
              "YYYY-mm-dd"
            ],
            "optional": true,
            "field": "from",
            "description": "<p>date filter; default value = class start_date</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "allowedValues": [
              "YYYY-mm-dd"
            ],
            "optional": true,
            "field": "to",
            "description": "<p>date filter; default value = class end_date</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the user's ID</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "published_at",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "perfect_score",
            "description": "<p>the expected total score of the periodical</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student_score",
            "description": "<p>the score achieved by the student</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "rating",
            "description": "<p>the percentage rate</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n\t{\n\t\t\"id\": 23,\n\t\t\"published_at\": \"2020-07-12 18:03:33\",\n\t\t\"title\": \"periodical 1 - written\",\n\t\t\"perfect_score\": \"12\",\n\t\t\"student_score\": 0,\n\t\t\"rating\": 0\n\t}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ReportController.php",
    "groupTitle": "Reports",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/reports/projects",
    "title": "Project scores",
    "version": "1.0.0",
    "name": "ProjectScores",
    "description": "<p>Returns scores of individual projects</p>",
    "group": "Reports",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>the class ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "user_id",
            "description": "<p>the user ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "allowedValues": [
              "YYYY-mm-dd"
            ],
            "optional": true,
            "field": "from",
            "description": "<p>date filter; default value = class start_date</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "allowedValues": [
              "YYYY-mm-dd"
            ],
            "optional": true,
            "field": "to",
            "description": "<p>date filter; default value = class end_date</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the user's ID</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "published_at",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "perfect_score",
            "description": "<p>the expected total score of the project</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student_score",
            "description": "<p>the score achieved by the student</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "rating",
            "description": "<p>the percentage rate</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n\t{\n\t\t\"id\": 4,\n\t\t\"published_at\": \"2020-06-30 00:00:00\",\n\t\t\"title\": \"New Project Test\",\n\t\t\"perfect_score\": 100,\n\t\t\"student_score\": \"76\",\n\t\t\"rating\": \"0.7600\"\n\t},\n\t{\n\t\t\"id\": 9,\n\t\t\"published_at\": \"2020-06-30 00:00:00\",\n\t\t\"title\": \"New Project Test - min score\",\n\t\t\"perfect_score\": 1,\n\t\t\"student_score\": 0,\n\t\t\"rating\": 0\n\t}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ReportController.php",
    "groupTitle": "Reports",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/reports/quizzes",
    "title": "Quiz Scores",
    "version": "1.0.0",
    "name": "QuizScores",
    "description": "<p>Returns scores of individual quizzes</p>",
    "group": "Reports",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>the class ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "user_id",
            "description": "<p>the user ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "allowedValues": [
              "YYYY-mm-dd"
            ],
            "optional": true,
            "field": "from",
            "description": "<p>date filter; default value = class start_date</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "allowedValues": [
              "YYYY-mm-dd"
            ],
            "optional": true,
            "field": "to",
            "description": "<p>date filter; default value = class end_date</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the user's ID</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "published_at",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "perfect_score",
            "description": "<p>the expected total score of the quiz</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student_score",
            "description": "<p>the score achieved by the student</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "rating",
            "description": "<p>the percentage rate</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n\t{\n\t\t\"id\": 22,\n\t\t\"published_at\": \"2020-07-12 18:02:35\",\n\t\t\"title\": \"quiz1 - written\",\n\t\t\"perfect_score\": \"12\",\n\t\t\"student_score\": \"7\",\n\t\t\"rating\": 0.5833333333333334\n\t},\n\t{\n\t\t\"id\": 22,\n\t\t\"published_at\": \"2020-07-12 18:02:35\",\n\t\t\"title\": \"quiz1 - written\",\n\t\t\"perfect_score\": \"12\",\n\t\t\"student_score\": \"7\",\n\t\t\"rating\": 0.5833333333333334\n\t},\n\t{\n\t\t\"id\": 25,\n\t\t\"published_at\": \"2020-07-31 15:31:30\",\n\t\t\"title\": \"quiz4 - written\",\n\t\t\"perfect_score\": \"12\",\n\t\t\"student_score\": 0,\n\t\t\"rating\": 0\n\t}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ReportController.php",
    "groupTitle": "Reports",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "HOST/api/class/attendance/save",
    "title": "Record Attendance",
    "version": "1.0.0",
    "name": "RecordAttendance",
    "description": "<p>Records the user's class attendance</p>",
    "group": "Reports",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": "<p>the student ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "schedule_id",
            "description": "<p>the schedule ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>the class ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "allowedValues": [
              "1",
              "2"
            ],
            "optional": false,
            "field": "status",
            "description": "<p>default is 1 if not specified <br> 1: Present, 2: Absent</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "reason",
            "description": ""
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": "<p>the class ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "user_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>the class ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "schedule",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "schedule.id",
            "description": "<p>the schedule ID</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "schedule.date_from",
            "description": "<p>session start date/time</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "schedule.date_to",
            "description": "<p>session end date/time</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "schedule.attendance",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "schedule.attendance.attendance_id",
            "description": "<p>the attendance record ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "schedule.attendance.status",
            "description": "<p>1:Present 2:Absent</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "schedule.attendance.remark",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "schedule.attendance.reason",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"student_id\": 2,\n    \"username\": \"grace\",\n    \"first_name\": \"grace\",\n    \"last_name\": \"ungui\",\n    \"user_type\": \"s\",\n    \"class_id\": 1,\n    \"schedule\": {\n        \"id\": 3,\n        \"from\": \"2020-05-19 09:00:00\",\n        \"to\": \"2020-05-19 10:00:00\",\n        \"attendance\": {\n            \"attendance_id\": 20,\n            \"status\": 2,\n            \"remark\": \"Absent\",\n            \"reason\": \"tired3\"\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AttendanceController.php",
    "groupTitle": "Reports"
  },
  {
    "type": "get",
    "url": "HOST/api/class/schedule-attendance",
    "title": "Schedule attendance",
    "version": "1.0.0",
    "name": "ScheduleClassAttendance",
    "description": "<p>Get attendances of the given schedule ID</p>",
    "group": "Reports",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>the class ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "schedule_id",
            "description": "<p>the schedule_id</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>the class ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "schedule_id",
            "description": "<p>the schedule id</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "from",
            "description": "<p>schedule start date/time</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "to",
            "description": "<p>schedule end date/time</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "attendance_records",
            "description": "<p>list of attendances for this schedule</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "attendance_records.user_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "attendance_records.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "attendance_records.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "NumberOrNull",
            "allowedValues": [
              "1",
              "2",
              "null"
            ],
            "optional": false,
            "field": "attendance_records.status_flag",
            "description": "<p>the attendance status</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "attendance_records.remark",
            "description": "<p>Values: Present, Absent, No record</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "attendance_records.reason",
            "description": "<p>reasons of absence if any</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"class_id\": 2,\n    \"schedule_id\": 2,\n    \"from\": \"2020-05-18 09:00:00\",\n    \"to\": \"2020-05-18 10:00:00\",\n    \"attendance_records\": [\n        {\n            \"user_id\": 1,\n            \"first_name\": \"jayson\",\n            \"last_name\": \"barino\",\n            \"status\": 1,\n            \"remark\": \"Present\",\n            \"reason\": null\n        },\n        {},\n        {}\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AttendanceController.php",
    "groupTitle": "Reports"
  },
  {
    "type": "get",
    "url": "<HOST>/api/reports/seatworks",
    "title": "Seatwork scores",
    "version": "1.0.0",
    "name": "SeatworkScores",
    "description": "<p>Returns scores of individual seatworks</p>",
    "group": "Reports",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>the class ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "user_id",
            "description": "<p>the user ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "allowedValues": [
              "YYYY-mm-dd"
            ],
            "optional": true,
            "field": "from",
            "description": "<p>date filter; default value = class start_date</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "allowedValues": [
              "YYYY-mm-dd"
            ],
            "optional": true,
            "field": "to",
            "description": "<p>date filter; default value = class end_date</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the user's ID</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "published_at",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "perfect_score",
            "description": "<p>the expected total score of the seatwork</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student_score",
            "description": "<p>the score achieved by the student</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "rating",
            "description": "<p>the percentage rate</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n\t{\n\t\t\"id\": 4,\n\t\t\"published_at\": \"2020-06-30 00:00:00\",\n\t\t\"title\": \"New Seatwork Test\",\n\t\t\"perfect_score\": 100,\n\t\t\"student_score\": \"76\",\n\t\t\"rating\": \"0.7600\"\n\t},\n\t{\n\t\t\"id\": 9,\n\t\t\"published_at\": \"2020-06-30 00:00:00\",\n\t\t\"title\": \"New Seatwork Test - min score\",\n\t\t\"perfect_score\": 1,\n\t\t\"student_score\": 0,\n\t\t\"rating\": 0\n\t}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ReportController.php",
    "groupTitle": "Reports",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/activity/attempt/show",
    "title": "Get the student's answer details",
    "version": "1.0.0",
    "name": "StudentAnswerDetails",
    "description": "<p>Returns the student's answers</p>",
    "group": "Reports",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "attempt_id",
            "description": "<p>the ID of submission/attempt</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "activity_id",
            "description": "<p>the activity_id</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the activity ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "instruction",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "duration",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "questionnaires",
            "description": "<p>refer to <a href='#api-Questionnaire-QuestionnaireDetail'><font color='blue'><HOST>/api/questionnaire/:id</font></a> for the questionnaire details</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "questionnaires.questions.student_answer",
            "description": "<p>the student's answer; Under the &quot;question&quot; object</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "questionnaires.questions.student_answer.is_correct",
            "description": "<p>1: student answered correctly, 2: student answered wrongly</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "questionnaires.questions.student_answer.answer",
            "description": "<p>the student's answer</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "\t\t{\n\t\t\t\"id\": 17,\n\t\t\t\"title\": \"quiz2 - written\",\n\t\t\t\"instruction\": \"answer this\",\n\t\t\t\"duration\": 60,\n\t\t\t\"questionnaires\": [\n\t\t\t\t{\n\t\t\t\t\t\"id\": 2,\n\t\t\t\t\t\"title\": \"Questionnaire 1\",\n\t\t\t\t\t\"intro\": \"this is a quiz to answer\",\n\t\t\t\t\t\"subject_id\": 1,\n\t\t\t\t\t\"school_published\": 0,\n\t\t\t\t\t\"school_published_date\": null,\n\t\t\t\t\t\"author\": {\n\t\t\t\t\t\t\"id\": 8,\n\t\t\t\t\t\t\"first_name\": \"teacher tom\",\n\t\t\t\t\t\t\"last_name\": \"cruz\"\n\t\t\t\t\t},\n\t\t\t\t\t\"questions\": [\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"id\": 3,\n\t\t\t\t\t\t\t\"question\": \"test\",\n\t\t\t\t\t\t\t\"question_type\": \"mcq\",\n\t\t\t\t\t\t\t\"media_url\": \"http://sample-media.com/q1-quiz1\",\n\t\t\t\t\t\t\t\"weight\": 1,\n\t\t\t\t\t\t\t\"choices\": [\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"d\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"e\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t}\n\t\t\t\t\t\t\t],\n                            \"student_answer\": {\n                                \"is_correct\": 1,\n                                \"answer\": \"test 3\"\n                            }\n\t\t\t\t\t\t},\n\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\"id\": 4,\n\t\t\t\t\t\t\t\"question\": \"test2\",\n\t\t\t\t\t\t\t\"question_type\": \"mcq\",\n\t\t\t\t\t\t\t\"media_url\": \"http://sample-media.com/q2-quiz1\",\n\t\t\t\t\t\t\t\"weight\": 5,\n\t\t\t\t\t\t\t\"choices\": [\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"a\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 0\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"b\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t\t},\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\"option\": \"c\",\n\t\t\t\t\t\t\t\t\t\"is_correct\": 1\n\t\t\t\t\t\t\t\t}\n\t\t\t\t\t\t\t],\n                            \"student_answer\": {\n                                \"is_correct\": 1,\n                                \"answer\": \"test 4\"\n                            }\n\t\t\t\t\t\t}\n\t\t\t\t\t]\n\t\t\t\t}\n\t\t\t]\n\t\t}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityAnswerController.php",
    "groupTitle": "Reports",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/activity/attempts",
    "title": "List of Activity Attempts",
    "version": "1.0.0",
    "name": "StudentAttemptsList",
    "description": "<p>Returns the list of submissions/attempts of the student of the given activity ID</p>",
    "group": "Reports",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "activity_id",
            "description": "<p>the activity ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": "<p>the student ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "activity_id",
            "description": "<p>the activity ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": "<p>the student ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "attempt_id",
            "description": "<p>ID of submission/attempt</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "perfect_score",
            "description": "<p>the total score of the activity</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "achieved_score",
            "description": "<p>the student's score</p>"
          },
          {
            "group": "Success 200",
            "type": "Double",
            "optional": false,
            "field": "achieved_score_percent",
            "description": "<p>student's score in percentage</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "taken_at",
            "description": "<p>the time of submission</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"activity_id\": 34,\n        \"student_id\": 1,\n        \"attempt_id\": \"16010883475f6eab5beda037.17196012\",\n        \"achieved_score\": \"11\",\n        \"perfect_score\": \"25\",\n        \"achieved_score_percent\": 0.44,\n        \"taken_at\": \"2020-09-26 10:45:48\"\n    },\n    {\n        \"activity_id\": 34,\n        \"student_id\": 1,\n        \"attempt_id\": \"16010924155f6ebb3f99c1b1.79708317\",\n        \"achieved_score\": \"15\",\n        \"perfect_score\": \"25\",\n        \"achieved_score_percent\": 0.6,\n        \"taken_at\": \"2020-09-26 11:53:36\"\n    }\n    {},\n    {}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityAnswerController.php",
    "groupTitle": "Reports",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/students/improvement",
    "title": "Student Improvements",
    "version": "1.0.0",
    "name": "StudentImprovements",
    "description": "<p>Returns list of class and student's improvement of a teacher (from auth)</p>",
    "group": "Reports",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>Class ID; if not supplied, will return all classes of a teacher</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>student improvement ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>Class ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "class_name",
            "description": "<p>Name of Class</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": "<p>Student ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "student_first_name",
            "description": "<p>First name of student</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "student_last_name",
            "description": "<p>Last name of student</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "improvement",
            "description": "<p>Improvement notes</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n\t{\n\t\t\"class_id\": 4,\n\t\t\"class_name\": \"MAPEH 201\",\n\t\t\"student_id\": 7,\n\t\t\"student_first_name\": \"vhen\",\n\t\t\"student_last_name\": \"fernandez\",\n\t\t\"improvement\": \"testing improvement\"\n\t},\n\t{\n\t\t\"class_id\": 3,\n\t\t\"class_name\": \"English 201\",\n\t\t\"student_id\": 5,\n\t\t\"student_first_name\": \"jacque\",\n\t\t\"student_last_name\": \"amaya\",\n\t\t\"improvement\": null\n\t}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentController.php",
    "groupTitle": "Reports",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "HOST/api/class/my-attendance",
    "title": "User class attendance",
    "version": "1.0.0",
    "name": "UserClassAttendance",
    "description": "<p>List of user's class attendance</p>",
    "group": "Reports",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>the class ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "user_id",
            "description": "<p>the user_id</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "schedule_id",
            "description": "<p>the schedule id</p>"
          },
          {
            "group": "Success 200",
            "type": "NumberOrNull",
            "allowedValues": [
              "1",
              "2",
              "null"
            ],
            "optional": false,
            "field": "status_flag",
            "description": "<p>the attendance status</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "remark",
            "description": "<p>Values: Present, Absent, No record</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "from",
            "description": "<p>schedule start date/time</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "to",
            "description": "<p>schedule end date/time</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "reason",
            "description": "<p>reasons of absence if any</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"schedule_id\": 2,\n        \"status_flag\": 1,\n        \"remark\": \"Present\",\n        \"from\": \"2020-05-18 09:00:00\",\n        \"to\": \"2020-05-18 10:00:00\",\n        \"reason\": null\n    },\n    {\n        \"schedule_id\": 1,\n        \"status_flag\": 2,\n        \"remark\": \"Absent\",\n        \"from\": \"2020-05-15 09:00:00\",\n        \"to\": \"2020-05-15 10:00:00\",\n        \"reason\": \"family gathering\"\n    },\n    {\n        \"schedule_id\": 3,\n        \"status_flag\": 2,\n        \"remark\": \"Absent\",\n        \"from\": \"2020-05-19 09:00:00\",\n        \"to\": \"2020-05-19 10:00:00\",\n        \"reason\": \"sick\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AttendanceController.php",
    "groupTitle": "Reports"
  },
  {
    "type": "post",
    "url": "<HOST>/api/activity/scores",
    "title": "Get Students Scores of the activity",
    "version": "1.0.0",
    "name": "studentActivityScores",
    "description": "<p>Returns the scores of the students of the given activity ID</p>",
    "group": "Reports",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "activity_id",
            "description": "<p>the activity ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "activity_id",
            "description": "<p>the activity ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": "<p>the student ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "perfect_score",
            "description": "<p>the total score of the activity</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "achieved_score",
            "description": "<p>the student's score</p>"
          },
          {
            "group": "Success 200",
            "type": "Double",
            "optional": false,
            "field": "achieved_score_percent",
            "description": "<p>student's score in percentage</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "attempts",
            "description": "<p>number of submissions/takes from students</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"activity_id\": 34,\n        \"student_id\": 5,\n        \"first_name\": \"jacque\",\n        \"last_name\": \"amaya\",\n        \"perfect_score\": 25,\n        \"achieved_score\": 0,\n        \"achieved_score_percent\": 0,\n        \"attempts\": 0\n    },\n    {\n        \"activity_id\": 34,\n        \"student_id\": 4,\n        \"first_name\": \"davy\",\n        \"last_name\": \"castillo\",\n        \"perfect_score\": 25,\n        \"achieved_score\": 0,\n        \"achieved_score_percent\": 0,\n        \"attempts\": 0\n    },\n    {},\n    {}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityAnswerController.php",
    "groupTitle": "Reports",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "HOST/api/schedule/:id",
    "title": "Schedule Detail",
    "version": "1.0.0",
    "name": "ScheduleDetail",
    "description": "<p>Returns schedule detail of specified ID</p>",
    "group": "Schedule",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>The schedule ID</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/Api/ScheduleController.php",
    "groupTitle": "Schedule",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Unique schedule id</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "from",
            "description": "<p>Session start</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "to",
            "description": "<p>Session end</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>Session status: done, canceled</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "teacher",
            "description": "<p>teacher handling this session</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "teacher.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.first_name",
            "description": "<p>Teacher name</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.last_name",
            "description": "<p>Teacher name</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "materials",
            "description": "<p>Class resources: notes, lessons, etc</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "materials.id",
            "description": "<p>Unique material id</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.uploaded_file",
            "description": "<p>If there's any uploaded file e.g. pdf, word, excel, ppt</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.resource_link",
            "description": "<p>Link to materials e.g google doc, website,etc</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "materials.added_by",
            "description": "<p>Someone who added the material</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "materials.added_by.id",
            "description": "<p>ID of uploader</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.added_by.name",
            "description": "<p>Name of uploader</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "activities",
            "description": "<p>List of activities attached to the session</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "activities.id",
            "description": "<p>The activity id</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.description",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.activity_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "activities.available_from",
            "description": "<p>Empty if it's a class activity. Date will be specified if given as assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "activities.available_to",
            "description": "<p>Empty if it's a class activity. Date will be specified if given as assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.status",
            "description": "<p>published/unpublished</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "activities.materials",
            "description": "<p>Array of reading materials needed for this activity</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "activities.materials.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.materials.title",
            "description": "<p>Title of the Activity Material</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.materials.uploaded_file",
            "description": "<p>If there's any uploaded file e.g. pdf, word, excel, ppt</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.materials.resource_link",
            "description": "<p>Link to materials e.g google doc, website,etc</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 1,\n    \"from\": \"2020-05-15 01:00:00\",\n    \"to\": \"2020-05-15 02:00:00\",\n    \"teacher\": {\n        \"id\": 9,\n        \"first_name\": \"teacher jayson\",\n        \"last_name\": \"barino\"\n    },\n    \"status\": 0,\n    \"materials\": [\n        {\n            \"id\": 1,\n            \"title\": \"English Writing Part 1\",\n            \"instruction\": \"read the textbook\",\n            \"description\": \"learn english writing\",\n            \"uploaded_file\": null,\n            \"resource_link\": \"https://sample-lesson-link.com/english-writing-part1\",\n            \"added_by\": {\n                \"id\": 8,\n                \"name\": null\n            }\n        },\n        {\n            \"id\": 2,\n            \"title\": \"English Writing Part 1\",\n            \"instruction\": \"read the textbook\",\n            \"description\": \"learn english writing\",\n            \"uploaded_file\": null,\n            \"resource_link\": \"https://sample-lesson-link.com/english-writing-part2\",\n            \"added_by\": {\n                \"id\": 8,\n                \"name\": null\n            }\n        }\n    ],\n    \"activities\": [\n        {\n            \"id\": 1,\n            \"title\": \"English Assignment 1\",\n            \"instruction\": \"read it\",\n            \"available_from\": \"2020-05-11\",\n            \"available_to\": \"2020-05-15\",\n            \"materials\": [\n                {\n                    \"id\": 1,\n                    \"title\": \"Sample Title\",\n                    \"uploaded_file\": \"\",\n                    \"resource_link\": \"http://read-english.com/basics\"\n                },\n                {\n                    \"id\": 2,\n                    \"title\": \"Sample Title\",\n                    \"uploaded_file\": \"\",\n                    \"resource_link\": \"http://read-english.com/basics2\"\n                }\n            ]\n        },\n        {\n            \"id\": 2,\n            \"title\": \"English Assignment 2\",\n            \"instruction\": \"read it\",\n            \"available_from\": \"2020-05-20\",\n            \"available_to\": \"2020-05-30\",\n            \"materials\": [\n                {\n                    \"id\": 3,\n                    \"title\": \"Sample Title\",\n                    \"uploaded_file\": \"\",\n                    \"resource_link\": \"http://read-english.com/basics3\"\n                }\n            ]\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "HOST/api/schedule/save",
    "title": "Schedule Edit",
    "version": "1.0.0",
    "name": "ScheduleEdit",
    "description": "<p>Allows editing schedule and returns the schdule object</p>",
    "group": "Schedule",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>The ID of schedule to be updated</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "optional": false,
            "field": "from",
            "description": "<p>New start date/time (YYYY-mm-dd H:i:s)</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "optional": false,
            "field": "to",
            "description": "<p>New end date/time  (YYYY-mm-dd H:i:s)</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "teacher_id",
            "description": "<p>User ID of new assigned teacher</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "allowedValues": [
              "PENDING",
              "DONE",
              "ONGOING",
              "CANCELED"
            ],
            "optional": false,
            "field": "status",
            "description": ""
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the schedule ID</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "from",
            "description": "<p>session start time</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "to",
            "description": "<p>schedule end time</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "teacher",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "teacher.id",
            "description": "<p>the teacher ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "PENDING",
              "DONE",
              "ONGOING",
              "CANCELED"
            ],
            "optional": false,
            "field": "status",
            "description": "<p>schedule status</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 1,\n    \"from\": \"2020-05-21 10:00:00\",\n    \"to\": \"2020-05-21 11:00:00\",\n    \"teacher\": {\n        \"id\": 9,\n        \"first_name\": \"teacher jayson\",\n        \"last_name\": \"barino\"\n    },\n    \"status\": \"DONE\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ScheduleController.php",
    "groupTitle": "Schedule",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "HOST/api/schooladmin/teachers",
    "title": "School Teachers",
    "version": "1.0.0",
    "name": "SchoolTeachers",
    "description": "<p>Get List of school teachers</p>",
    "group": "School_Admin",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>teacher's ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "user_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "phone_number",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "preferences",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "preferences.profile_picture",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "preferences.push_notifications",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "preferences.email_subscription",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n\t{\n\t\t\"id\": 8,\n\t\t\"first_name\": \"teacher tom\",\n\t\t\"last_name\": \"cruz\",\n\t\t\"school_id\": 1,\n\t\t\"user_type\": \"t\",\n\t\t\"username\": \"ttom\",\n\t\t\"email\": \"xxx@gamil.com\",\n\t\t\"phone_number\": 111,\n\t\t\"status\": 1,\n\t\t\"preferences\": {\n\t\t\t\"profile_picture\": \"https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/NuAwve8r1j20KLNde6HjFQVhxGp4Q69p0KO38wIL.jpeg\",\n\t\t\t\"push_notification\": 1,\n\t\t\t\"email_subscription\": 0\n\t\t}\n\t},\n\t{}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/SchoolController.php",
    "groupTitle": "School_Admin",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/student/class-seatworks/:id",
    "title": "List Class Seatworks by Schedule (for student)",
    "version": "1.0.0",
    "name": "ClassSeatworksStudent",
    "description": "<p>Returns list of published class seatworks classified by (array of)schedules</p>",
    "group": "Seatworks",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the class ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the schedule ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Datetime",
            "optional": false,
            "field": "from",
            "description": "<p>date/time start of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Datetime",
            "optional": false,
            "field": "to",
            "description": "<p>date/time end of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "teacher",
            "description": "<p>the teacher handling this session (could be different from the class adviser if re-assignment happens)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "teacher.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.profile_picture",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "PENDING",
              "ONGOING",
              "DONE",
              "CANCELED"
            ],
            "optional": false,
            "field": "status",
            "description": "<p>the schedule status</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "publishedSeatworks",
            "description": "<p>list of published seatworks for this schedule</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "publishedSeatworks.id",
            "description": "<p>the seatwork ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedSeatworks.title",
            "description": "<p>the seatwork title</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedSeatworks.description",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "seatwork"
            ],
            "optional": false,
            "field": "publishedSeatworks.activity_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "publishedSeatworks.grading_category",
            "description": "<p>the category ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "publishedSeatworks.total_score",
            "description": "<p>the expected perfect score</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "publishedSeatworks.due_date",
            "description": "<p>deadline for the seatwork to be taken</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "published"
            ],
            "optional": false,
            "field": "publishedSeatworks.status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "publishedSeatworks.done",
            "description": "<p>indicates whether the seatwork is open or closed.</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "publishedSeatworks.materials",
            "description": "<p>list of materials attached to this seatwork</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "publishedSeatworks.materials.id",
            "description": "<p>the material ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedSeatworks.materials.title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedSeatworks.materials.uploaded_file",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedSeatworks.materials.resource_link",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 2,\n        \"from\": \"2020-05-18 09:00:00\",\n        \"to\": \"2020-05-18 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\",\n            \"profile_picture\": \"https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/NuAwve8r1j20KLNde6HjFQVhxGp4Q69p0KO38wIL.jpeg\"\n        },\n        \"status\": \"PENDING\",\n        \"publishedSeatworks\": [\n            {\n                \"id\": 6,\n                \"title\": \"New Seatwork Test\",\n                \"description\": \"Seatwork description\",\n                \"activity_type\": \"seatwork\",\n                \"grading_category\": 1,\n                \"total_score\": 100,\n                \"due_date\": \"2020-07-10 10:00:00\",\n                \"status\": \"published\",\n                \"done\": \"false\",\n                \"materials\": [\n                    {\n                        \"id\": 6,\n                        \"title\": \"Test Title 2\",\n                        \"uploaded_file\": \"\",\n                        \"resource_link\": \"sample-activity-material-link3.com\"\n                    }\n                ]\n            }\n        ]\n    },\n    {},\n    {}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ScheduleController.php",
    "groupTitle": "Seatworks",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/teacher/class-seatworks/:id",
    "title": "List Class Seatworks by Schedule (for teacher)",
    "version": "1.0.0",
    "name": "ClassSeatworksTeacher",
    "description": "<p>Returns list of class seatworks classified by (array of)schedules</p>",
    "group": "Seatworks",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the class ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the schedule ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Datetime",
            "optional": false,
            "field": "from",
            "description": "<p>date/time start of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Datetime",
            "optional": false,
            "field": "to",
            "description": "<p>date/time end of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "teacher",
            "description": "<p>the teacher handling this session (could be different from the class adviser if re-assignment happens)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "teacher.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.profile_picture",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "PENDING",
              "ONGOING",
              "DONE",
              "CANCELED"
            ],
            "optional": false,
            "field": "status",
            "description": "<p>the schedule status</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "publishedSeatworks",
            "description": "<p>list of published seatworks for this schedule</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "publishedSeatworks.id",
            "description": "<p>the seatwork ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedSeatworks.title",
            "description": "<p>the seatwork title</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedSeatworks.description",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "seatwork"
            ],
            "optional": false,
            "field": "publishedSeatworks.activity_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "publishedSeatworks.grading_category",
            "description": "<p>the category ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "publishedSeatworks.total_score",
            "description": "<p>the expected perfect score</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "publishedSeatworks.due_date",
            "description": "<p>deadline for the seatwork to be taken</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "published"
            ],
            "optional": false,
            "field": "publishedSeatworks.status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "publishedSeatworks.done",
            "description": "<p>indicates whether the seatwork is open or closed.</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "publishedSeatworks.materials",
            "description": "<p>list of materials attached to this seatwork</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "publishedSeatworks.materials.id",
            "description": "<p>the material ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedSeatworks.materials.title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedSeatworks.materials.uploaded_file",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "publishedSeatworks.materials.resource_link",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "unpublishedSeatworks",
            "description": "<p>list of published seatworks for this schedule</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "unpublishedSeatworks.id",
            "description": "<p>the seatwork ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "unpublishedSeatworks.title",
            "description": "<p>the seatwork title</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "unpublishedSeatworks.description",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "seatwork"
            ],
            "optional": false,
            "field": "unpublishedSeatworks.activity_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "unpublishedSeatworks.grading_category",
            "description": "<p>the category ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "unpublishedSeatworks.total_score",
            "description": "<p>the expected perfect score</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "unpublishedSeatworks.due_date",
            "description": "<p>deadline for the seatwork to be taken</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "unpublished"
            ],
            "optional": false,
            "field": "unpublishedSeatworks.status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "unpublishedSeatworks.done",
            "description": "<p>indicates whether the seatwork is open or closed.</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "unpublishedSeatworks.materials",
            "description": "<p>list of materials attached to this seatwork</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "unpublishedSeatworks.materials.id",
            "description": "<p>the material ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "unpublishedSeatworks.materials.title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "unpublishedSeatworks.materials.uploaded_file",
            "description": "<p>link to uploaded file</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "unpublishedSeatworks.materials.resource_link",
            "description": "<p>a shared reference link (google docs, etc)</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 2,\n        \"from\": \"2020-05-18 09:00:00\",\n        \"to\": \"2020-05-18 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\",\n            \"profile_picture\": \"https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/NuAwve8r1j20KLNde6HjFQVhxGp4Q69p0KO38wIL.jpeg\"\n        },\n        \"status\": \"PENDING\",\n        \"publishedSeatworks\": [\n            {\n                \"id\": 6,\n                \"title\": \"New Seatwork Test\",\n                \"description\": \"Seatwork description\",\n                \"activity_type\": \"seatwork\",\n                \"grading_category\": 1,\n                \"total_score\": 100,\n                \"due_date\": \"2020-07-10 10:00:00\",\n                \"status\": \"published\",\n                \"done\": \"false\",\n                \"materials\": [\n                    {\n                        \"id\": 6,\n                        \"title\": \"Test Title 2\",\n                        \"uploaded_file\": \"\",\n                        \"resource_link\": \"sample-activity-material-link3.com\"\n                    }\n                ]\n            }\n        ],\n        \"unpublishedSeatworks\": [\n            {\n                \"id\": 3,\n                \"title\": \"New assignment Test\",\n                \"description\": \"Seatwork description\",\n                \"activity_type\": \"seatwork\",\n                \"grading_category\": 1,\n                \"total_score\": 100,\n                \"due_date\": \"2020-07-10 10:00:00\",\n                \"status\": \"unpublished\",\n                \"done\": \"false\",\n                \"materials\": []\n            },\n            {\n                \"id\": 8,\n                \"title\": \"New Seatwork Test\",\n                \"description\": \"Seatwork description\",\n                \"activity_type\": \"seatwork\",\n                \"grading_category\": 1,\n                \"total_score\": 100,\n                \"due_date\": \"2020-07-10 10:00:00\",\n                \"status\": \"unpublished\",\n                \"done\": \"false\",\n                \"materials\": []\n            }\n        ]\n    },\n    {},\n    {}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ScheduleController.php",
    "groupTitle": "Seatworks",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "<HOST>/api/class/seatwork/get-score/:id",
    "title": "Get Seatwork Score",
    "version": "1.0.0",
    "name": "GetSeatworkScore",
    "description": "<p>Shows the score of student(s) of the given seatwork ID</p>",
    "group": "Seatworks",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": "<p>the student ID. If not provided, displays scores of all students in the class</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>score record ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "activity_id",
            "description": "<p>the seatwork ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "score",
            "description": "<p>achieved points</p>"
          },
          {
            "group": "Success 200",
            "type": "Double",
            "optional": false,
            "field": "score_percentage",
            "description": "<p>score rating</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "\t\t{\n            \"id\": 2,\n            \"student_id\": \"2\",\n            \"activity_id\": \"4\",\n            \"score\": \"80\",\n            \"score_percentage\": 0.8\n        }",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityScoreController.php",
    "groupTitle": "Seatworks",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/teacher/remove/class-seatwork/:id",
    "title": "Delete Seatwork",
    "version": "1.0.0",
    "name": "SeatworkDelete",
    "description": "<p>Delete the seatwork</p>",
    "group": "Seatworks",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of seatwork to be deleted</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Seatworks",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/class/seatwork/mark-done/:id",
    "title": "Mark Done",
    "version": "1.0.0",
    "name": "SeatworkDone",
    "description": "<p>Mark seatwork to done</p>",
    "group": "Seatworks",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of seatwork to be done/closed</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Seatworks",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/class/seatwork/mark-not-done/:id",
    "title": "Mark Undone",
    "version": "1.0.0",
    "name": "SeatworkUndone",
    "description": "<p>Mark seatwork to undone</p>",
    "group": "Seatworks",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of seatwork to be undone/open</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Seatworks",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "<HOST>/api/class/seatwork/set-score",
    "title": "Set Seatwork Score",
    "version": "1.0.0",
    "name": "SetSeatworkScore",
    "description": "<p>Sets a student seatwork score</p>",
    "group": "Seatworks",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "score",
            "description": "<p>score of the student</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": "<p>user ID of the student</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "activity_id",
            "description": "<p>activity ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>score record ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "activity_id",
            "description": "<p>the seatwork ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "score",
            "description": "<p>achieved points</p>"
          },
          {
            "group": "Success 200",
            "type": "Double",
            "optional": false,
            "field": "score_percentage",
            "description": "<p>score rating</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "\t\t{\n            \"id\": 2,\n            \"student_id\": \"2\",\n            \"activity_id\": \"4\",\n            \"score\": \"80\",\n            \"score_percentage\": 0.8\n        }",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/StudentActivityScoreController.php",
    "groupTitle": "Seatworks",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/student/seatwork-answers/:id",
    "title": "View Answers (for student)",
    "version": "1.0.0",
    "name": "ShowSeatworkAnswerStudent",
    "description": "<p>Show the current student's answer of the given seatwork</p>",
    "group": "Seatworks",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the seatwork ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>record ID of the answer</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "assignment_id",
            "description": "<p>the seatwork ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "answer_media",
            "description": "<p>link to the uploaded answer</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "student",
            "description": "<p>student details who submitted the answer</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "student.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "student.last_name",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 3,\n        \"assignment_id\": 6,\n        \"answer_media\": \"http://api.schoolhub.local:8080/api/download/activity/answer/3\",\n        \"answer_text\": \"Answer Text Sample\",\n        \"student\": {\n            \"id\": 1,\n            \"first_name\": \"jayson\",\n            \"last_name\": \"barino\"\n        }\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentAnswerController.php",
    "groupTitle": "Seatworks",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/teacher/seatwork-answers/:id",
    "title": "View Answers (for teacher)",
    "version": "1.0.0",
    "name": "ShowSeatworkAnswerTeacher",
    "description": "<p>Show the student's answer of the given seatwork</p>",
    "group": "Seatworks",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the seatwork ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": true,
            "field": "student_id",
            "description": "<p>if supplied, returns the answer of the specific student only</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>record ID of the answer</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "assignment_id",
            "description": "<p>the seatwork ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "answer_media",
            "description": "<p>link to the uploaded answer</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "student",
            "description": "<p>student details who submitted the answer</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "student.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "student.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "student.last_name",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 3,\n        \"assignment_id\": 6,\n        \"answer_media\": \"http://api.schoolhub.local:8080/api/download/activity/answer/3\",\n        \"answer_text\": \"Answer Text Sample\",\n        \"student\": {\n            \"id\": 1,\n            \"first_name\": \"jayson\",\n            \"last_name\": \"barino\"\n        }\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentAnswerController.php",
    "groupTitle": "Seatworks",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/upload/seatwork/answer",
    "title": "Upload Answer (For student)",
    "version": "1.0.0",
    "name": "UploadSeatworkAnswer",
    "description": "<p>Upload seatwork answer</p>",
    "group": "Seatworks",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "File",
            "allowedValues": [
              "*.jpeg",
              "*.bmp",
              "*.png",
              "*.gif",
              "*.pdf",
              "*.doc",
              "*.txt"
            ],
            "optional": false,
            "field": "file",
            "description": "<p>The file to be uploaded</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "assignment_id",
            "description": "<p>the activity id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "answer_text",
            "description": "<p>free text answer</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/FileController.php",
    "groupTitle": "Seatworks",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/upload/seatwork/material",
    "title": "Add Material (FILE)",
    "version": "1.0.0",
    "name": "UploadSeatworkMaterial",
    "description": "<p>Upload seatwork material/resource for student's reference</p>",
    "group": "Seatworks",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "File",
            "allowedValues": [
              "*.jpeg",
              "*.bmp",
              "*.png",
              "*.gif",
              "*.pdf",
              "*.doc",
              "*.txt"
            ],
            "optional": false,
            "field": "file",
            "description": "<p>The file to be uploaded</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "assignment_id",
            "description": "<p>the activity id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>file title</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/FileController.php",
    "groupTitle": "Seatworks",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/class/seatwork/save",
    "title": "Add/Edit Seatwork",
    "version": "1.0.0",
    "name": "addSeatwork",
    "description": "<p>Add new seatwork</p>",
    "group": "Seatworks",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>title of seatwork</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "DateTime",
            "optional": false,
            "field": "due_date",
            "description": "<p>deadline of seatwork to be submitted</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "allowedValues": [
              "0",
              "1"
            ],
            "optional": false,
            "field": "published",
            "description": "<p>0: not published, 1:published</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "subject_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "schedule_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "total_score",
            "description": "<p>the expected perfect score for this seatwork</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "grading_category",
            "description": "<p>the grading category ID</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Seatworks",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of the created seatwork</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "seatwork"
            ],
            "optional": false,
            "field": "activity_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "grading_category",
            "description": "<p>the grading category ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "total_score",
            "description": "<p>the expected perfect score for this seatwork</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "due_date",
            "description": "<p>deadline of seatwork to be submitted</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "unpublished",
              "published"
            ],
            "optional": false,
            "field": "status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "done",
            "description": "<p>indicates if seatwork is closed/open for takes</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "materials",
            "description": "<p>array of materials attached to the assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "materials.id",
            "description": "<p>material ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.title",
            "description": "<p>material title</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.uploaded_file",
            "description": "<p>link to uploaded file if any</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.resource_link",
            "description": "<p>URL link to resource</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 6,\n    \"title\": \"New Seatwork Test\",\n    \"description\": \"Seatwork description\",\n    \"activity_type\": \"seatwork\",\n    \"grading_category\": 1,\n    \"total_score\": 100,\n    \"due_date\": \"2020-07-10 10:00:00\",\n    \"status\": \"unpublished\",\n    \"done\": \"false\",\n    \"materials\": [\n        {\n            \"id\": 4,\n            \"title\": \"Test assignment 2\",\n            \"uploaded_file\": \"\",\n            \"resource_link\": \"sample-activity-material-link3.com\"\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/class/seatwork-material/save",
    "title": "Add/Edit Material (URL)",
    "version": "1.0.0",
    "name": "addSeatworkMaterialUrl",
    "description": "<p>Add a link to seatwork's material</p>",
    "group": "Seatworks",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": true,
            "field": "id",
            "description": "<p>if supplied, edits the existing material</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "activity_id",
            "description": "<p>ID of seatwork</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>link to resource</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the ID of added material</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "uploaded_file",
            "description": "<p>link to uploaded file if any</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "resource_link",
            "description": "<p>URL to resource</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 7,\n    \"title\": \"Test Title 2\",\n    \"uploaded_file\": \"\",\n    \"resource_link\": \"sample-activity-material-link3.com\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Seatworks",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/class/seatwork/publish/:id",
    "title": "Publish Seatwork",
    "version": "1.0.0",
    "name": "publishSeatworks",
    "description": "<p>Publish seatwork to be available for students</p>",
    "group": "Seatworks",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of seatwork to be published</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Seatworks",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/teacher/remove/class-seatwork-material/:id",
    "title": "Delete Seatwork Material",
    "version": "1.0.0",
    "name": "removeSeatworkMaterial",
    "description": "<p>Remove attached material from the seatwork</p>",
    "group": "Seatworks",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the seatwork ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "allowedValues": [
              "true",
              "false"
            ],
            "optional": false,
            "field": "success",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Seatworks",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "HOST/api/class/seatwork/:id",
    "title": "Seatwork Details",
    "version": "1.0.0",
    "name": "showSeatwork",
    "description": "<p>Show seatwork details</p>",
    "group": "Seatworks",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of seatwork to be viewed</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Seatworks",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of the created seatwork</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "seatwork"
            ],
            "optional": false,
            "field": "activity_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "grading_category",
            "description": "<p>the grading category ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "total_score",
            "description": "<p>the expected perfect score for this seatwork</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "due_date",
            "description": "<p>deadline of seatwork to be submitted</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "unpublished",
              "published"
            ],
            "optional": false,
            "field": "status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "done",
            "description": "<p>indicates if seatwork is closed/open for takes</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "materials",
            "description": "<p>array of materials attached to the assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "materials.id",
            "description": "<p>material ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.title",
            "description": "<p>material title</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.uploaded_file",
            "description": "<p>link to uploaded file if any</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.resource_link",
            "description": "<p>URL link to resource</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 6,\n    \"title\": \"New Seatwork Test\",\n    \"description\": \"Seatwork description\",\n    \"activity_type\": \"seatwork\",\n    \"grading_category\": 1,\n    \"total_score\": 100,\n    \"due_date\": \"2020-07-10 10:00:00\",\n    \"status\": \"unpublished\",\n    \"done\": \"false\",\n    \"materials\": [\n        {\n            \"id\": 4,\n            \"title\": \"Test assignment 2\",\n            \"uploaded_file\": \"\",\n            \"resource_link\": \"sample-activity-material-link3.com\"\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "",
    "url": "<HOST>/api/teacher/class/:id",
    "title": "Get class details",
    "version": "1.0.0",
    "name": "ClassDetail",
    "description": "<p>Returns a class object of the specified {id}</p>",
    "group": "Student_Classes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the class ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "schedules"
            ],
            "optional": false,
            "field": "include",
            "description": "<p>available relations to include</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Unique class id</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Defined class name</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Class description</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "bg_image",
            "description": "<p>class background image</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "frequency",
            "description": "<p>The frequency of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "date_from",
            "description": "<p>Start of class</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "date_to",
            "description": "<p>End of class</p>"
          },
          {
            "group": "Success 200",
            "type": "Time",
            "optional": false,
            "field": "time_from",
            "description": "<p>Class duration</p>"
          },
          {
            "group": "Success 200",
            "type": "Time",
            "optional": false,
            "field": "time_to",
            "description": "<p>Class duration</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "next_schedule",
            "description": "<p>the next session</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "next_schedule.from",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "next_schedule.to",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "subject",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "subject.name",
            "description": "<p>The subject name</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "teacher",
            "description": "<p>The teacher handling the class</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "teacher.id",
            "description": "<p>Unique teacher id</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.name",
            "description": "<p>The teacher's name</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "schedules",
            "description": "<p>array of class schedules; not included by default</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "schedules.id",
            "description": "<p>the schedule ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "schedules.from",
            "description": "<p>date/time start of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "schedules.to",
            "description": "<p>date/time end of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "schedules.teacher",
            "description": "<p>the teacher handling this session (could be different from the class adviser if re-assignment happens)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "schedules.teacher.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "schedules.teacher.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "schedules.teacher.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "schedules.status",
            "description": "<p>&quot;&quot; or CANCELED</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "students",
            "description": "<p>array of students enrolled in the class; not included by default</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "students.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "students.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "students.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "students.school_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "students.user_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "students.username",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "students.email",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "students.phone_number",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "students.status",
            "description": "<p>1:active, 0-inactive</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 1,\n    \"name\": \"English 101\",\n    \"description\": \"learn basics\",\n    \"bg_image\": \"https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/GFChqQIl5s587gLV0SEoEA0q8mr7CICPWdVBTW7H.jpeg\",\n    \"frequency\": \"M,W,F\",\n    \"date_from\": \"2020-05-11\",\n    \"date_to\": \"2020-05-15\",\n    \"time_from\": \"09:00:00\",\n    \"time_to\": \"10:00:00\",\n    \"next_schedule\": {\n        \"from\": \"2020-05-25 09:00:00\",\n        \"to\": \"2020-05-25 10:00:00\"\n    },\n    \"color\": \"#b12d8b\",\n    \"subject\": {\n        \"id\": 1,\n        \"name\": \"English\"\n    },\n    \"teacher\": {\n        \"id\": 8,\n        \"first_name\": \"teacher tom\",\n        \"last_name\": \"cruz\"\n    },\n    \"schedules\": [\n        {\n            \"id\": 1,\n            \"from\": \"2020-05-15 09:00:00\",\n            \"to\": \"2020-05-15 10:00:00\",\n            \"teacher\": {\n                \"id\": 8,\n                \"first_name\": \"teacher tom\",\n                \"last_name\": \"cruz\"\n            },\n            \"status\": \"\"\n        },\n        {},\n    {}\n    ],\n    \"students\": [\n        {\n            \"id\": 1,\n            \"first_name\": \"jayson\",\n            \"last_name\": \"barino\",\n            \"school_id\": 1,\n            \"user_type\": \"s\",\n            \"username\": \"jayson\",\n            \"email\": \"barinojayson@gmail.con\",\n            \"phone_number\": 111,\n            \"status\": 1\n        },\n        {},\n        {}\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ClassController.php",
    "groupTitle": "Student_Classes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "",
    "url": "<HOST>/api/teacher/class-materials/:id",
    "title": "Get class materials (by schedule)",
    "version": "1.0.0",
    "name": "ClassMaterials",
    "description": "<p>Returns list of class materials classified by (array of)schedules</p>",
    "group": "Student_Classes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the class ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the schedule ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "from",
            "description": "<p>date/time start of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "to",
            "description": "<p>date/time end of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "teacher",
            "description": "<p>the teacher handling this session (could be different from the class adviser if re-assignment happens)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "teacher.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "PENDING",
              "ONGOING",
              "DONE",
              "CANCELED"
            ],
            "optional": false,
            "field": "status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "materials",
            "description": "<p>list of materials used in the session (or empty)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "materials.id",
            "description": "<p>the activity ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.uploaded_file",
            "description": "<p>link to uploaded file or</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.resource_link",
            "description": "<p>a shared reference link (google docs, etc)</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "added_by",
            "description": "<p>the teacher/user who added this material</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "added_by.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.last_name",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 1,\n        \"from\": \"2020-05-15 09:00:00\",\n        \"to\": \"2020-05-15 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\"\n        },\n        \"status\": \"\",\n        \"materials\": [\n            {\n                \"id\": 1,\n                \"title\": \"English Writing Part 1\",\n                \"uploaded_file\": \"\",\n                \"resource_link\": \"https://sample-lesson-link.com/english-writing-part1\",\n                \"added_by\": {\n                    \"id\": 8,\n                    \"first_name\": \"teacher tom\",\n                    \"last_name\": \"cruz\"\n                }\n            },\n            {\n                \"id\": 2,\n                \"title\": \"English Writing Part 1\",\n                \"uploaded_file\": \"http://link-to-uploaded-file/sample\",\n                \"resource_link\": \"\",\n                \"added_by\": {\n                    \"id\": 8,\n                    \"first_name\": \"teacher tom\",\n                    \"last_name\": \"cruz\"\n                }\n            }\n        ]\n    },\n    {\n        \"id\": 2,\n        \"from\": \"2020-05-18 09:00:00\",\n        \"to\": \"2020-05-18 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\"\n        },\n        \"status\": \"\",\n        \"materials\": []\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ScheduleController.php",
    "groupTitle": "Student_Classes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "",
    "url": "<HOST>/api/student/class-schedules/:id",
    "title": "Get class schedules",
    "version": "1.0.0",
    "name": "ClassSchedules",
    "description": "<p>Returns array of class schedules</p>",
    "group": "Student_Classes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the class ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "materials",
              "activities"
            ],
            "optional": false,
            "field": "include",
            "description": "<p>comma separated; available relations to include</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the schedule ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "from",
            "description": "<p>date/time start of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "to",
            "description": "<p>date/time end of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "teacher",
            "description": "<p>the teacher handling this session (could be different from the class adviser if re-assignment happens)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "teacher.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "PENDING",
              "ONGOING",
              "DONE",
              "CANCELED"
            ],
            "optional": false,
            "field": "status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "materials",
            "description": "<p>list of materials used in the session (or empty)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "materials.id",
            "description": "<p>the activity ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.uploaded_file",
            "description": "<p>link to uploaded file or</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.resource_link",
            "description": "<p>a shared reference link (google docs, etc)</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "materials.added_by",
            "description": "<p>the teacher/user who added this material</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "materials.added_by.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.added_by.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.added_by.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "activities",
            "description": "<p>the activitiy list of the session (or empty)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "activities.id",
            "description": "<p>the activity ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.desription",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.activit_type",
            "description": "<p>&quot;class activity&quot; or &quot;assignment&quot;</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "activities.available_from",
            "description": "<p>Empty if it's a class activity. Date will be specified if given as assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "activities.available_to",
            "description": "<p>Empty if it's a class activity. Date will be specified if given as assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.status",
            "description": "<p>&quot;published&quot; or &quot;unpublished&quot;</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "activities.materials",
            "description": "<p>array of references/materials for this activity (or empty)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "activities.materials.id",
            "description": "<p>the material ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.materials.title",
            "description": "<p>title of the Activity Material</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.materials.uploaded_file",
            "description": "<p>link to uploaded file or</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.materials.resource_link",
            "description": "<p>a shared reference link (google docs, etc)</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 1,\n        \"from\": \"2020-05-15 09:00:00\",\n        \"to\": \"2020-05-15 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\"\n        },\n        \"status\": \"\",\n        \"materials\": [\n            {\n                \"id\": 1,\n                \"title\": \"English Writing Part 1\",\n                \"uploaded_file\": \"\",\n                \"resource_link\": \"https://sample-lesson-link.com/english-writing-part1\",\n                \"added_by\": {\n                    \"id\": 8,\n                    \"first_name\": \"teacher tom\",\n                    \"last_name\": \"cruz\"\n                }\n            },\n            {}\n        ],\n        \"activities\": [\n            {\n                \"id\": 1,\n                \"title\": \"English Assignment 1\",\n                \"description\": \"read it\",\n                \"activity_type\": \"class activity\",\n                \"available_from\": \"2020-05-11\",\n                \"available_to\": \"2020-05-15\",\n                \"status\": \"unpublished\",\n                \"materials\": [\n                    {\n                        \"id\": 1,\n                        \"title\": \"Sample Title\",\n                        \"uploaded_file\": \"http://link-to-uploaded-file/sample\",\n                        \"resource_link\": \"\"\n                    },\n                    {\n                        \"id\": 2,\n                        \"title\": NULL,\n                        \"uploaded_file\": \"\",\n                        \"resource_link\": \"http://read-english.com/basics2\"\n                    }\n                ]\n            },\n            {}\n        ]\n    },\n    {\n        \"id\": 2,\n        \"from\": \"2020-05-18 09:00:00\",\n        \"to\": \"2020-05-18 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\"\n        },\n        \"status\": \"\",\n        \"materials\": [],\n        \"activities\": []\n    },\n    {},\n    {}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ScheduleController.php",
    "groupTitle": "Student_Classes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "HOST/api/student/classes",
    "title": "get class list",
    "version": "1.0.0",
    "name": "StudentClassList",
    "description": "<p>Returns array of classes where the logged in student is currently enrolled</p>",
    "group": "Student_Classes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "student_id",
            "description": "<p>User ID of the student. Required if logged in as a parent</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "id",
            "optional": false,
            "field": "id",
            "description": "<p>the student ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "school_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "user_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "phone_number",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>1:active, 0-inactive</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "classes",
            "description": "<p>list of classes</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "classes.id",
            "description": "<p>the class ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "classes.name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "classes.description",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "classes.bg_image",
            "description": "<p>class background image</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "classes.frequency",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "classes.date_from",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "classes.date_to",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "classes.time_from",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "classes.time_to",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "next_schedule",
            "description": "<p>the next session</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "next_schedule.from",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "next_schedule.to",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "subject",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.id",
            "description": "<p>the subject ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "subject.name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "teacher",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "teacher.id",
            "description": "<p>teacher ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.last_name",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 1,\n    \"first_name\": \"jayson\",\n    \"last_name\": \"barino\",\n    \"school_id\": 1,\n    \"user_type\": \"s\",\n    \"user_name\": \"jayson\",\n    \"email\": \"barinojayson@gmail.con\",\n    \"phone_number\": 111,\n    \"status\": 1,\n    \"classes\": [\n        {\n            \"id\": 1,\n            \"name\": \"English 101\",\n            \"description\": \"learn basics\",\n            \"bg_image\": \"https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/GFChqQIl5s587gLV0SEoEA0q8mr7CICPWdVBTW7H.jpeg\",\n            \"frequency\": \"M,W,F\",\n            \"date_from\": \"2020-05-11\",\n            \"date_to\": \"2020-05-15\",\n            \"time_from\": \"09:00:00\",\n            \"time_to\": \"10:00:00\",\n            \"next_schedule\": {\n                \"from\": \"2020-05-25 09:00:00\",\n                \"to\": \"2020-05-25 10:00:00\"\n            },\n            \"subject\": {\n                \"id\": 1,\n                \"name\": \"English\"\n            },\n            \"teacher\": {\n                \"id\": 8,\n                \"first_name\": \"teacher tom\",\n                \"last_name\": \"cruz\"\n            }\n        },\n        {},\n        {}\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ClassController.php",
    "groupTitle": "Student_Classes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "",
    "url": "<HOST>/api/teacher/class/:id",
    "title": "Get class details",
    "version": "1.0.0",
    "name": "ClassDetail",
    "description": "<p>Returns a class object of the specified {id}</p>",
    "group": "Teacher_Classes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the class ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "schedules",
              "students"
            ],
            "optional": false,
            "field": "include",
            "description": "<p>available relations to include</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Unique class id</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Defined class name</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Class description</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "bg_image",
            "description": "<p>class background image</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "frequency",
            "description": "<p>The frequency of session</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "color",
            "description": "<p>The color assigned to the class</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "date_from",
            "description": "<p>Start of class</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "date_to",
            "description": "<p>End of class</p>"
          },
          {
            "group": "Success 200",
            "type": "Time",
            "optional": false,
            "field": "time_from",
            "description": "<p>Class duration</p>"
          },
          {
            "group": "Success 200",
            "type": "Time",
            "optional": false,
            "field": "time_to",
            "description": "<p>Class duration</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "next_schedule",
            "description": "<p>the next session</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "next_schedule.from",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "next_schedule.to",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "subject",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "subject.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "subject.name",
            "description": "<p>The subject name</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "teacher",
            "description": "<p>the class adviser</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "teacher.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.profile_picture",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "schedules",
            "description": "<p>array of class schedules; not included by default</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "schedules.id",
            "description": "<p>the schedule ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "schedules.from",
            "description": "<p>date/time start of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "schedules.to",
            "description": "<p>date/time end of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "schedules.teacher",
            "description": "<p>the teacher handling this session (could be different from the class adviser if re-assignment happens)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "schedules.teacher.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "schedules.teacher.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "schedules.teacher.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "schedules.teacher.profile_picture",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "schedules.status",
            "description": "<p>&quot;&quot; or CANCELED</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "students",
            "description": "<p>array of students enrolled in the class; not included by default</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "students.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "students.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "students.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "students.school_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "students.user_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "students.username",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "students.email",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "students.phone_number",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "students.status",
            "description": "<p>1:active, 0-inactive</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "students.preferences",
            "description": "<p>user preferences</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "students.preferences.profile_picture",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "students.preferences.push_notfication",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "students.preferences.email_subscription",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 1,\n    \"name\": \"English 101\",\n    \"description\": \"learn basics\",\n    \"bg_image\": \"https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/GFChqQIl5s587gLV0SEoEA0q8mr7CICPWdVBTW7H.jpeg\",\n    \"frequency\": \"M,W,F\",\n    \"date_from\": \"2020-05-11\",\n    \"date_to\": \"2020-05-15\",\n    \"time_from\": \"09:00:00\",\n    \"time_to\": \"10:00:00\",\n    \"next_schedule\": {\n        \"from\": \"2020-05-25 09:00:00\",\n        \"to\": \"2020-05-25 10:00:00\"\n    },\n    \"color\": \"#b12d8b\",\n    \"subject\": {\n        \"id\": 1,\n        \"name\": \"English\"\n    },\n    \"teacher\": {\n        \"id\": 8,\n        \"first_name\": \"teacher tom\",\n        \"last_name\": \"cruz\",\n        \"profile_picture\": \"https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/NuAwve8r1j20KLNde6HjFQVhxGp4Q69p0KO38wIL.jpeg\"\n    },\n    \"schedules\": [\n        {\n            \"id\": 1,\n            \"from\": \"2020-05-15 09:00:00\",\n            \"to\": \"2020-05-15 10:00:00\",\n            \"teacher\": {\n                \"id\": 8,\n                \"first_name\": \"teacher tom\",\n                \"last_name\": \"cruz\",\n                \"profile_picture\": \"https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/NuAwve8r1j20KLNde6HjFQVhxGp4Q69p0KO38wIL.jpeg\"\n\n            },\n            \"status\": \"\"\n        },\n        {},\n    {}\n    ],\n    \"students\": [\n        {\n            \"id\": 1,\n            \"first_name\": \"jayson\",\n            \"last_name\": \"barino\",\n            \"school_id\": 1,\n            \"user_type\": \"s\",\n            \"username\": \"jayson\",\n            \"email\": \"barinojayson@gmail.con\",\n            \"phone_number\": 111,\n            \"status\": 1,\n            \"preferences\": {\n                \"profile_picture\": \"https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/ZeXzRdWwYqb1McKBsuCYhfOJHHBAwB4f31f8NmVN.jpeg\",\n                \"push_notification\": 1,\n                \"email_subscription\": 0\n            }\n        },\n        {},\n        {}\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ClassController.php",
    "groupTitle": "Teacher_Classes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "",
    "url": "<HOST>/api/teacher/class-lesson-plans/:id",
    "title": "Get class lesson plans (by schedule)",
    "version": "1.0.0",
    "name": "ClassLessonPlans",
    "description": "<p>Returns list of class lesson plans classified by (array of)schedules</p>",
    "group": "Teacher_Classes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the class ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the schedule ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "from",
            "description": "<p>date/time start of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "to",
            "description": "<p>date/time end of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "teacher",
            "description": "<p>the teacher handling this session (could be different from the class adviser if re-assignment happens)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "teacher.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "PENDING",
              "ONGOING",
              "DONE",
              "CANCELED"
            ],
            "optional": false,
            "field": "status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "lesson",
            "description": "<p>plan list of lesson plans used in the session (or empty)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "lessonPlans.id",
            "description": "<p>the Lesson Plan ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "lessonPlans.title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "lessonPlans.uploaded_file",
            "description": "<p>link to uploaded file or</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "lessonPlans.resource_link",
            "description": "<p>a shared reference link (google docs, etc)</p>"
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "lessonPlans.done",
            "description": "<p>returns true if lesson plan has been marked as done, otherwise, false</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "added_by",
            "description": "<p>the teacher/user who added this lesson plan</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "added_by.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.last_name",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "        [\n\t\t\t{\n\t\t\t\t\"id\": 6,\n\t\t\t\t\"from\": \"2020-05-22 09:00:00\",\n\t\t\t\t\"to\": \"2020-05-22 10:00:00\",\n\t\t\t\t\"teacher\": {\n\t\t\t\t\t\"id\": 9,\n\t\t\t\t\t\"first_name\": \"teacher jayson\",\n\t\t\t\t\t\"last_name\": \"barino\"\n\t\t\t\t},\n\t\t\t\t\"status\": \"\",\n\t\t\t\t\"lessonPlans\": [\n\t\t\t\t\t{\n\t\t\t\t\t\t\"id\": 1,\n\t\t\t\t\t\t\"title\": \"Hello Lesson Plan\",\n\t\t\t\t\t\t\"uploaded_file\": \"\",\n\t\t\t\t\t\t\"resource_link\": \"http://sample-lesson-plan-link.com\",\n\t\t\t\t\t\t\"added_by\": {\n\t\t\t\t\t\t\t\"id\": 9,\n\t\t\t\t\t\t\t\"first_name\": \"teacher jayson\",\n\t\t\t\t\t\t\t\"last_name\": \"barino\"\n\t\t\t\t\t\t}\n\t\t\t\t\t}\n\t\t\t\t]\n\t\t\t},\n\t\t\t{\n\t\t\t\t\"id\": 7,\n\t\t\t\t\"from\": \"2020-05-25 09:00:00\",\n\t\t\t\t\"to\": \"2020-05-25 10:00:00\",\n\t\t\t\t\"teacher\": {\n\t\t\t\t\t\"id\": 9,\n\t\t\t\t\t\"first_name\": \"teacher jayson\",\n\t\t\t\t\t\"last_name\": \"barino\"\n\t\t\t\t},\n\t\t\t\t\"status\": \"\",\n\t\t\t\t\"lessonPlans\": []\n\t\t\t},\n\t\t\t{\n\t\t\t\t\"id\": 8,\n\t\t\t\t\"from\": \"2020-05-26 09:00:00\",\n\t\t\t\t\"to\": \"2020-05-26 10:00:00\",\n\t\t\t\t\"teacher\": {\n\t\t\t\t\t\"id\": 9,\n\t\t\t\t\t\"first_name\": \"teacher jayson\",\n\t\t\t\t\t\"last_name\": \"barino\"\n\t\t\t\t},\n\t\t\t\t\"status\": \"\",\n\t\t\t\t\"lessonPlans\": []\n\t\t\t},\n\t\t\t{\n\t\t\t\t\"id\": 9,\n\t\t\t\t\"from\": \"2020-05-27 09:00:00\",\n\t\t\t\t\"to\": \"2020-05-27 10:00:00\",\n\t\t\t\t\"teacher\": {\n\t\t\t\t\t\"id\": 9,\n\t\t\t\t\t\"first_name\": \"teacher jayson\",\n\t\t\t\t\t\"last_name\": \"barino\"\n\t\t\t\t},\n\t\t\t\t\"status\": \"\",\n\t\t\t\t\"lessonPlans\": []\n\t\t\t},\n\t\t\t{\n\t\t\t\t\"id\": 10,\n\t\t\t\t\"from\": \"2020-05-28 09:00:00\",\n\t\t\t\t\"to\": \"2020-05-28 10:00:00\",\n\t\t\t\t\"teacher\": {\n\t\t\t\t\t\"id\": 9,\n\t\t\t\t\t\"first_name\": \"teacher jayson\",\n\t\t\t\t\t\"last_name\": \"barino\"\n\t\t\t\t},\n\t\t\t\t\"status\": \"\",\n\t\t\t\t\"lessonPlans\": []\n\t\t\t}\n\t\t]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ScheduleController.php",
    "groupTitle": "Teacher_Classes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "",
    "url": "<HOST>/api/teacher/class-materials/:id",
    "title": "Get class materials (by schedule)",
    "version": "1.0.0",
    "name": "ClassMaterials",
    "description": "<p>Returns list of class materials classified by (array of)schedules</p>",
    "group": "Teacher_Classes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the class ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the schedule ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "from",
            "description": "<p>date/time start of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "to",
            "description": "<p>date/time end of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "teacher",
            "description": "<p>the teacher handling this session (could be different from the class adviser if re-assignment happens)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "teacher.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "PENDING",
              "ONGOING",
              "DONE",
              "CANCELED"
            ],
            "optional": false,
            "field": "status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "materials",
            "description": "<p>list of materials used in the session (or empty)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "materials.id",
            "description": "<p>the activity ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.uploaded_file",
            "description": "<p>link to uploaded file or</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.resource_link",
            "description": "<p>a shared reference link (google docs, etc)</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "added_by",
            "description": "<p>the teacher/user who added this material</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "added_by.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "added_by.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "done",
            "description": "<p>returns true if the class material has been marked as done, otherwise, false.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 1,\n        \"from\": \"2020-05-15 09:00:00\",\n        \"to\": \"2020-05-15 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\"\n        },\n        \"status\": \"\",\n        \"materials\": [\n            {\n                \"id\": 1,\n                \"title\": \"English Writing Part 1\",\n                \"uploaded_file\": \"\",\n                \"resource_link\": \"https://sample-lesson-link.com/english-writing-part1\",\n                \"added_by\": {\n                    \"id\": 8,\n                    \"first_name\": \"teacher tom\",\n                    \"last_name\": \"cruz\"\n                }\n            },\n            {\n                \"id\": 2,\n                \"title\": \"English Writing Part 1\",\n                \"uploaded_file\": \"http://link-to-uploaded-file/sample\",\n                \"resource_link\": \"\",\n                \"added_by\": {\n                    \"id\": 8,\n                    \"first_name\": \"teacher tom\",\n                    \"last_name\": \"cruz\"\n                }\n            }\n        ]\n    },\n    {\n        \"id\": 2,\n        \"from\": \"2020-05-18 09:00:00\",\n        \"to\": \"2020-05-18 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\"\n        },\n        \"status\": \"\",\n        \"materials\": []\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ScheduleController.php",
    "groupTitle": "Teacher_Classes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "",
    "url": "<HOST>/api/teacher/class-schedules/:id",
    "title": "Get class schedules",
    "version": "1.0.0",
    "name": "ClassSchedules",
    "description": "<p>Returns array of class schedules</p>",
    "group": "Teacher_Classes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the class ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "materials",
              "activities",
              "lessonPlans"
            ],
            "optional": false,
            "field": "include",
            "description": "<p>comma separated; available relations to include</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the schedule ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "from",
            "description": "<p>date/time start of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "to",
            "description": "<p>date/time end of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "teacher",
            "description": "<p>the teacher handling this session (could be different from the class adviser if re-assignment happens)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "teacher.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "PENDING",
              "ONGOING",
              "DONE",
              "CANCELED"
            ],
            "optional": false,
            "field": "status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "materials",
            "description": "<p>list of materials used in the session (or empty)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "materials.id",
            "description": "<p>the activity ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.uploaded_file",
            "description": "<p>link to uploaded file or</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.resource_link",
            "description": "<p>a shared reference link (google docs, etc)</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "materials.added_by",
            "description": "<p>the teacher/user who added this material</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "materials.added_by.id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.added_by.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "materials.added_by.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "activities",
            "description": "<p>the activitiy list of the session (or empty)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "activities.id",
            "description": "<p>the activity ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.desription",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.activit_type",
            "description": "<p>&quot;class activity&quot; or &quot;assignment&quot;</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "activities.available_from",
            "description": "<p>Empty if it's a class activity. Date will be specified if given as assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "activities.available_to",
            "description": "<p>Empty if it's a class activity. Date will be specified if given as assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.status",
            "description": "<p>&quot;published&quot; or &quot;unpublished&quot;</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "activities.materials",
            "description": "<p>array of references/materials for this activity (or empty)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "activities.materials.id",
            "description": "<p>the material ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.materials.title",
            "description": "<p>Title of the Activity Material</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.materials.uploaded_file",
            "description": "<p>link to uploaded file or</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "activities.materials.resource_link",
            "description": "<p>a shared reference link (google docs, etc)</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 1,\n        \"from\": \"2020-05-15 09:00:00\",\n        \"to\": \"2020-05-15 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\"\n        },\n        \"status\": \"\",\n        \"materials\": [\n            {\n                \"id\": 1,\n                \"title\": \"English Writing Part 1\",\n                \"uploaded_file\": \"\",\n                \"resource_link\": \"https://sample-lesson-link.com/english-writing-part1\",\n                \"added_by\": {\n                    \"id\": 8,\n                    \"first_name\": \"teacher tom\",\n                    \"last_name\": \"cruz\"\n                }\n            },\n            {}\n        ],\n        \"activities\": [\n            {\n                \"id\": 1,\n                \"title\": \"English Assignment 1\",\n                \"description\": \"read it\",\n                \"activity_type\": \"class activity\",\n                \"available_from\": \"2020-05-11\",\n                \"available_to\": \"2020-05-15\",\n                \"status\": \"published\",\n                \"materials\": [\n                    {\n                        \"id\": 1,\n                        \"title\": \"Sample Title\",\n                        \"uploaded_file\": \"http://link-to-uploaded-file/sample\",\n                        \"resource_link\": \"\"\n                    },\n                    {\n                        \"id\": 2,\n                        \"title\": \"Sample Title\",\n                        \"uploaded_file\": \"\",\n                        \"resource_link\": \"http://read-english.com/basics2\"\n                    }\n                ]\n            },\n            {}\n        ]\n    },\n    {\n        \"id\": 2,\n        \"from\": \"2020-05-18 09:00:00\",\n        \"to\": \"2020-05-18 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\"\n        },\n        \"status\": \"\",\n        \"materials\": [],\n        \"activities\": []\n    },\n    {},\n    {}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ScheduleController.php",
    "groupTitle": "Teacher_Classes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "",
    "url": "<HOST>/api/teacher/class-students/:id",
    "title": "Get list of students",
    "version": "1.0.0",
    "name": "ClassStudentList",
    "description": "<p>Returns array of students enrolled in the class</p>",
    "group": "Teacher_Classes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>the class ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "id",
            "optional": false,
            "field": "id",
            "description": "<p>the student ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "first_name",
            "description": "<p>Defined class name</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "last_name",
            "description": "<p>Class description</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "school_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "user_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "phone_number",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>1:active, 0-inactive</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 1,\n        \"first_name\": \"jayson\",\n        \"last_name\": \"barino\",\n        \"school_id\": 1,\n        \"user_type\": \"s\",\n        \"user_name\": \"jayson\",\n        \"email\": \"barinojayson@gmail.con\",\n        \"phone_number\": 111,\n        \"status\": 1\n    },\n    {},\n    {}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ClassController.php",
    "groupTitle": "Teacher_Classes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "HOST/api/teacher/remove/class/:id",
    "title": "Remove Class",
    "version": "1.0.0",
    "name": "RemoveClass",
    "description": "<p>Removes a Class</p>",
    "group": "Teacher_Classes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of Class Material</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>returns true if ID is found. Otherwise, returns error code 404.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ClassController.php",
    "groupTitle": "Teacher_Classes"
  },
  {
    "type": "post",
    "url": "HOST/api/teacher/remove/class-material/:id",
    "title": "Remove Class Material",
    "version": "1.0.0",
    "name": "RemoveClassMaterial",
    "description": "<p>Removes a Class Material</p>",
    "group": "Teacher_Classes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of Class Material</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>returns true if ID is found. Otherwise, returns error code 404.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ClassController.php",
    "groupTitle": "Teacher_Classes"
  },
  {
    "type": "post",
    "url": "HOST/api/teacher/remove/class-lesson-plan/:id",
    "title": "Remove Lesson Plan",
    "version": "1.0.0",
    "name": "RemoveLessonPlan",
    "description": "<p>Removes Lesson Plan</p>",
    "group": "Teacher_Classes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Lesson Plan ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>returns true if ID is found. Otherwise, returns error code 404.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"success\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/LessonPlanController.php",
    "groupTitle": "Teacher_Classes"
  },
  {
    "type": "GET",
    "url": "<HOST>/api/teacher/classes",
    "title": "Get class list",
    "version": "1.0.0",
    "name": "TeacherClassList",
    "description": "<p>Returns array of classes handled by teacher</p>",
    "group": "Teacher_Classes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "students",
              "schedules"
            ],
            "optional": false,
            "field": "include",
            "description": "<p>available includes when getting the class list</p>"
          },
          {
            "group": "Parameter",
            "type": "StringOrNumber",
            "optional": false,
            "field": "user_id",
            "description": "<p>retrieves list of classes of the specified user. If not passed, defaults to currently logged in user: &quot;me&quot;</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Unique class id</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Defined class name</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Class description</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "bg_image",
            "description": "<p>class background image</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "room_number",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "frequency",
            "description": "<p>The frequency of session</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "color",
            "description": "<p>The color assigned to the class</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "date_from",
            "description": "<p>Start of class</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "date_to",
            "description": "<p>End of class</p>"
          },
          {
            "group": "Success 200",
            "type": "Time",
            "optional": false,
            "field": "time_from",
            "description": "<p>Class duration</p>"
          },
          {
            "group": "Success 200",
            "type": "Time",
            "optional": false,
            "field": "time_to",
            "description": "<p>Class duration</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "next_schedule",
            "description": "<p>the next session</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "next_schedule.from",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "next_schedule.to",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "next_schedule.status",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "teacher",
            "description": "<p>The teacher handling the class</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "teacher.id",
            "description": "<p>Unique teacher id</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.first_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.last_name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.profile_picture",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "students",
            "description": "<p>refer to <a href='#api-Teacher_Classes-ClassDetail'>/api/teacher/class/:id</a> for the details</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "schedules",
            "description": "<p>refer to <a href='#api-Teacher_Classes-ClassDetail'>/api/teacher/class/:id</a> for the details</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 1,\n        \"name\": \"English 101\",\n        \"description\": \"learn basics\",\n        \"bg_image\": \"https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/GFChqQIl5s587gLV0SEoEA0q8mr7CICPWdVBTW7H.jpeg\",\n        \"room_number\": 123455,\n        \"frequency\": \"M,W,F\",\n        \"color\": \"#b12d8b\",\n        \"date_from\": \"2020-05-11\",\n        \"date_to\": \"2020-05-15\",\n        \"time_from\": \"09:00:00\",\n        \"time_to\": \"10:00:00\",\n        \"next_schedule\": {\n            \"from\": \"2020-05-25 09:00:00\",\n            \"to\": \"2020-05-25 10:00:00\"\n            \"status\": \"DONE\"\n        },\n        \"subject\": {\n            \"id\": 1,\n            \"name\": \"English\"\n        },\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\",\n            \"profile_picture\": \"https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/NuAwve8r1j20KLNde6HjFQVhxGp4Q69p0KO38wIL.jpeg\"\n        }\n        \"students\": [\n            {},\n            {}\n        ]\n        \"schedules\": [\n            {},\n            {}\n        ]\n    },\n    {},\n    {}\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ClassController.php",
    "groupTitle": "Teacher_Classes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  },
  {
    "type": "POST",
    "url": "HOST/api/class/user/",
    "title": "User Detail",
    "version": "1.0.0",
    "name": "UserDetail",
    "description": "<p>Get user details</p>",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of user. current user's ID if not supplied</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of user</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "first_name",
            "description": "<p>of the user</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "last_name",
            "description": "<p>of the user</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "school_id",
            "description": "<p>school ID of the user</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "user_type",
            "description": "<p>S - Student; T - Teacher</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>Username of the user</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>email address of user</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "phone_number",
            "description": "<p>phone number of user</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>1 - active; 0 - inactive</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "preference",
            "description": "<p>user preferences</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "preference.profile_picture",
            "description": "<p>URL of profile_picture</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "preference.push_notification",
            "description": "<p>1 - enabled; 0 disabled</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "preference.email",
            "description": "<p>1 - enabled; 0 disabled</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "        {\n\t\t\t\"id\": 9,\n\t\t\t\"first_name\": \"teacher jayson\",\n\t\t\t\"last_name\": \"barino\",\n\t\t\t\"school_id\": 1,\n\t\t\t\"user_type\": \"t\",\n\t\t\t\"username\": \"tjayson\",\n\t\t\t\"email\": \"xxx@gamil.com\",\n\t\t\t\"phone_number\": 111,\n\t\t\t\"status\": 1,\n\t\t\t\"preferences\": {\n\t\t\t\t\"profile_picture\": \"https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/NuAwve8r1j20KLNde6HjFQVhxGp4Q69p0KO38wIL.jpeg\",\n\t\t\t\t\"push_notification\": 1,\n\t\t\t\t\"email_subscription\": 0\n\t\t\t}\n\t\t}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/UserController.php",
    "groupTitle": "User",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  }
] });
