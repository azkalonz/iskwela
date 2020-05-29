define({ "api": [
  {
    "type": "POST",
    "url": "HOST/api/class/activity/{id}",
    "title": "Activity Detail",
    "version": "1.0.0",
    "name": "ActivityDetail",
    "description": "<p>Get activity details</p>",
    "group": "Activity",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of activity</p>"
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
            "description": "<p>Activity ID</p>"
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
            "optional": false,
            "field": "activity_type",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "available_from",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "available_to",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>published/unpublished</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "materials",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "materials.id",
            "description": "<p>any uploaded materials</p>"
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
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 1,\n    \"title\": \"English Assignment 1\",\n    \"instruction\": \"read it\",\n    \"activity_type\": \"class activity\",\n    \"available_from\": \"2020-05-11\",\n    \"available_to\": \"2020-05-15\",\n    \"status\": \"unpublished\",\n    \"materials\": [\n        {\n            \"id\": 1,\n            \"uploaded_file\": \"http://talina.local:8080/api/download/1\",\n            \"resource_link\": \"http://read-english.com/basics\"\n        },\n        {\n            \"id\": 2,\n            \"uploaded_file\": \"http://talina.local:8080/api/download/2\",\n            \"resource_link\": \"http://read-english.com/basics2\"\n        },\n        {\n            \"id\": 5,\n            \"uploaded_file\": \"http://talina.local:8080/api/download/5\",\n            \"resource_link\": null\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Activity",
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
    "url": "HOST/api/class/activity/save",
    "title": "Add/Edit Activity",
    "version": "1.0.0",
    "name": "AddActivity",
    "description": "<p>Save class activity and returns the activity details</p>",
    "group": "Activity",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Activity ID. If specified, edits the existing activity, otherwise, creates a new record</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": ""
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
            "type": "Number",
            "allowedValues": [
              "1",
              "2"
            ],
            "optional": false,
            "field": "activity_type",
            "description": "<p>1-class activity, 2-assignment</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "allowedValues": [
              "YYYY-mm-dd"
            ],
            "optional": false,
            "field": "available_from",
            "description": "<p>If set as assignment, can be null if session activity</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "allowedValues": [
              "YYYY-mm-dd"
            ],
            "optional": false,
            "field": "available_to",
            "description": "<p>If set as assignment, can be null if session activity</p>"
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
            "description": "<p>0-cannot be viewed by student, 1-publish to student</p>"
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
            "description": "<p>ID of session to which the activity will be attached</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "class_id",
            "description": "<p>Class ID to which the activity will be attached</p>"
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
            "description": "<p>Activity ID. The activity ID</p>"
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
            "optional": false,
            "field": "activity_type",
            "description": "<p>class activity or assignment</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "available_from",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "available_to",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>published/unpublished</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "materials",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "materials.id",
            "description": "<p>any uploaded materials</p>"
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
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"id\": 6,\n    \"title\": \"class activity sample edited\",\n    \"instruction\": \"this is a class activity\",\n    \"activity_type\": \"class activity\",\n    \"available_from\": null,\n    \"available_to\": null,\n    \"status\": \"published\",\n    \"materials\": [\n        {\n            \"id\": 4,\n            \"uploaded_file\": \"SCHOOL01/2020-05-21/121026-bargram.png\",\n            \"resource_link\": null\n        }\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Activity"
  },
  {
    "type": "POST",
    "url": "HOST/api/class/activity/publish/{id}",
    "title": "Publish Activity",
    "version": "1.0.0",
    "name": "PublishActivity",
    "description": "<p>Publish activity to students</p>",
    "group": "Activity",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>ID of activity to be published</p>"
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
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Activity",
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
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"access_token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90YWxpbmEubG9jYWw6ODA4MFwvYXBpXC9sb2dpbiIsImlhdCI6MTU4OTE5OTE4NSwiZXhwIjoxNTg5MjAyNzg1LCJuYmYiOjE1ODkxOTkxODUsImp0aSI6ImN2TVhWakdhNjRTT0x3NmkiLCJzdWIiOiJKREpWSkdELTdhbjZlbDUiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3Iiwia2V5Ijo4fQ.V_9sTyiSHk5VuaIm6uy3cGzigvqDRBoL4Ek7SjR49Vg\",\n    \"token_type\": \"Bearer\",\n    \"expires_in\": 3600\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/AuthController.php",
    "groupTitle": "Auth"
  },
  {
    "type": "POST",
    "url": "HOST/api/download/activity/answer/{id}",
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
    "url": "HOST/api/download/activity/material/{id}",
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
    "url": "HOST/api/download/class/material/{id}",
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
    "url": "HOST/api/download/class/lesson-plan/{id}",
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
    "url": "HOST/api/upload/activity/answer",
    "title": "",
    "version": "1.0.0",
    "name": "UploadActivityAnswer",
    "description": "<p>Allows adding answers to activity</p>",
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
            "field": "assignment_id",
            "description": "<p>the activity id</p>"
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
    "url": "HOST/api/upload/activity/material",
    "title": "Activity Material",
    "version": "1.0.0",
    "name": "UploadActivityMaterial",
    "description": "<p>Allows adding media to activity</p>",
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
            "field": "assignment_id",
            "description": "<p>the activity id</p>"
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
    "title": "",
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
              "*.gif",
              "*.pdf"
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
    "type": "",
    "url": "<HOST>/class/lesson-plan/save",
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
    "url": "HOST/api/class/attendance/{id}",
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
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"student_id\": 1,\n    \"username\": \"jayson\",\n    \"first_name\": \"jayson\",\n    \"last_name\": \"barino\",\n    \"user_type\": \"s\",\n    \"class_id\": 1,\n    \"schedule\": {\n        \"id\": 1,\n        \"from\": \"2020-05-15 09:00:00\",\n        \"to\": \"2020-05-15 10:00:00\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AttendanceController.php",
    "groupTitle": "Reports"
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
    "type": "post",
    "url": "HOST/api/schedule/{id}",
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
          "content": "{\n    \"id\": 1,\n    \"from\": \"2020-05-15 01:00:00\",\n    \"to\": \"2020-05-15 02:00:00\",\n    \"teacher\": {\n        \"id\": 9,\n        \"first_name\": \"teacher jayson\",\n        \"last_name\": \"barino\"\n    },\n    \"status\": 0,\n    \"materials\": [\n        {\n            \"id\": 1,\n            \"title\": \"English Writing Part 1\",\n            \"instruction\": \"read the textbook\",\n            \"description\": \"learn english writing\",\n            \"uploaded_file\": null,\n            \"resource_link\": \"https://sample-lesson-link.com/english-writing-part1\",\n            \"added_by\": {\n                \"id\": 8,\n                \"name\": null\n            }\n        },\n        {\n            \"id\": 2,\n            \"title\": \"English Writing Part 1\",\n            \"instruction\": \"read the textbook\",\n            \"description\": \"learn english writing\",\n            \"uploaded_file\": null,\n            \"resource_link\": \"https://sample-lesson-link.com/english-writing-part2\",\n            \"added_by\": {\n                \"id\": 8,\n                \"name\": null\n            }\n        }\n    ],\n    \"activities\": [\n        {\n            \"id\": 1,\n            \"title\": \"English Assignment 1\",\n            \"instruction\": \"read it\",\n            \"available_from\": \"2020-05-11\",\n            \"available_to\": \"2020-05-15\",\n            \"questions\": [\n                {\n                    \"id\": 1,\n                    \"question\": \"what is noun?\"\n                },\n                {\n                    \"id\": 2,\n                    \"question\": \"what is adverb\"\n                },\n                {\n                    \"id\": 3,\n                    \"question\": \"what is predicate?\"\n                }\n            ],\n            \"materials\": [\n                {\n                    \"id\": 1,\n                    \"uploaded_file\": \"\",\n                    \"resource_link\": \"http://read-english.com/basics\"\n                },\n                {\n                    \"id\": 2,\n                    \"uploaded_file\": \"\",\n                    \"resource_link\": \"http://read-english.com/basics2\"\n                }\n            ]\n        },\n        {\n            \"id\": 2,\n            \"title\": \"English Assignment 2\",\n            \"instruction\": \"read it\",\n            \"available_from\": \"2020-05-20\",\n            \"available_to\": \"2020-05-30\",\n            \"questions\": [\n                {\n                    \"id\": 4,\n                    \"question\": \"what is pronoun?\"\n                },\n                {\n                    \"id\": 5,\n                    \"question\": \"what is subject\"\n                },\n                {\n                    \"id\": 6,\n                    \"question\": \"what is plural?\"\n                }\n            ],\n            \"materials\": [\n                {\n                    \"id\": 3,\n                    \"uploaded_file\": \"\",\n                    \"resource_link\": \"http://read-english.com/basics3\"\n                }\n            ]\n        }\n    ]\n}",
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
    "type": "",
    "url": "<HOST>/api/student/class-activities/{id}",
    "title": "Get class activities (by schedule)",
    "version": "1.0.0",
    "name": "ClassActivities",
    "description": "<p>Returns list of class activities classified by (array of)schedules</p>",
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
            "field": "activities.activity_type",
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
            "description": "<p>&quot;published&quot;</p>"
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
          "content": "[\n    {\n        \"id\": 1,\n        \"from\": \"2020-05-15 09:00:00\",\n        \"to\": \"2020-05-15 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\"\n        },\n        \"status\": \"\",\n        \"publishedActivities\": [\n            {\n                \"id\": 1,\n                \"title\": \"English Assignment 1\",\n                \"description\": \"read it\",\n                \"activity_type\": \"class activity\",\n                \"available_from\": \"2020-05-11\",\n                \"available_to\": \"2020-05-15\",\n                \"status\": \"published\",\n                \"materials\": [\n                    {\n                        \"id\": 1,\n                        \"uploaded_file\": \"\",\n                        \"resource_link\": \"http://read-english.com/basics\"\n                    },\n                    {\n                        \"id\": 1,\n                        \"uploaded_file\": \"http://link-to-uploaded-file.com/sample\",\n                        \"resource_link\": \"\"\n                    },\n            {}\n                ]\n            },\n            {}\n        ]\n    },\n    {\n        \"id\": 2,\n        \"from\": \"2020-05-18 09:00:00\",\n        \"to\": \"2020-05-18 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\"\n        },\n        \"status\": \"\",\n        \"activities\": []\n    }\n]",
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
    "url": "<HOST>/api/teacher/class/{id}",
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
          "content": "{\n    \"id\": 1,\n    \"name\": \"English 101\",\n    \"description\": \"learn basics\",\n    \"frequency\": \"M,W,F\",\n    \"date_from\": \"2020-05-11\",\n    \"date_to\": \"2020-05-15\",\n    \"time_from\": \"09:00:00\",\n    \"time_to\": \"10:00:00\",\n    \"next_schedule\": {\n        \"from\": \"2020-05-25 09:00:00\",\n        \"to\": \"2020-05-25 10:00:00\"\n    },\n    \"subject\": {\n        \"id\": 1,\n        \"name\": \"English\"\n    },\n    \"teacher\": {\n        \"id\": 8,\n        \"first_name\": \"teacher tom\",\n        \"last_name\": \"cruz\"\n    },\n    \"schedules\": [\n        {\n            \"id\": 1,\n            \"from\": \"2020-05-15 09:00:00\",\n            \"to\": \"2020-05-15 10:00:00\",\n            \"teacher\": {\n                \"id\": 8,\n                \"first_name\": \"teacher tom\",\n                \"last_name\": \"cruz\"\n            },\n            \"status\": \"\"\n        },\n        {},\n    {}\n    ],\n    \"students\": [\n        {\n            \"id\": 1,\n            \"first_name\": \"jayson\",\n            \"last_name\": \"barino\",\n            \"school_id\": 1,\n            \"user_type\": \"s\",\n            \"username\": \"jayson\",\n            \"email\": \"barinojayson@gmail.con\",\n            \"phone_number\": 111,\n            \"status\": 1\n        },\n        {},\n        {}\n    ]\n}",
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
    "url": "<HOST>/api/teacher/class-materials/{id}",
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
    "url": "<HOST>/api/student/class-schedules/{id}",
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
          "content": "[\n    {\n        \"id\": 1,\n        \"from\": \"2020-05-15 09:00:00\",\n        \"to\": \"2020-05-15 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\"\n        },\n        \"status\": \"\",\n        \"materials\": [\n            {\n                \"id\": 1,\n                \"title\": \"English Writing Part 1\",\n                \"uploaded_file\": \"\",\n                \"resource_link\": \"https://sample-lesson-link.com/english-writing-part1\",\n                \"added_by\": {\n                    \"id\": 8,\n                    \"first_name\": \"teacher tom\",\n                    \"last_name\": \"cruz\"\n                }\n            },\n            {}\n        ],\n        \"activities\": [\n            {\n                \"id\": 1,\n                \"title\": \"English Assignment 1\",\n                \"description\": \"read it\",\n                \"activity_type\": \"class activity\",\n                \"available_from\": \"2020-05-11\",\n                \"available_to\": \"2020-05-15\",\n                \"status\": \"unpublished\",\n                \"materials\": [\n                    {\n                        \"id\": 1,\n                        \"uploaded_file\": \"http://link-to-uploaded-file/sample\",\n                        \"resource_link\": \"\"\n                    },\n                    {\n                        \"id\": 2,\n                        \"uploaded_file\": \"\",\n                        \"resource_link\": \"http://read-english.com/basics2\"\n                    }\n                ]\n            },\n            {}\n        ]\n    },\n    {\n        \"id\": 2,\n        \"from\": \"2020-05-18 09:00:00\",\n        \"to\": \"2020-05-18 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\"\n        },\n        \"status\": \"\",\n        \"materials\": [],\n        \"activities\": []\n    },\n    {},\n    {}\n]",
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
    "type": "post",
    "url": "HOST/student/activity-answers/{id}",
    "title": "Show Activity Answer",
    "version": "1.0.0",
    "name": "ShowActivityAnswer",
    "description": "<p>Get student's activity answers.</p>",
    "group": "Student_Classes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Activity ID</p>"
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
            "description": "<p>Activity Answer ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "assignment_id",
            "description": "<p>Activity ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "answer_media",
            "description": "<p>download link of the answer file</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 1,\n        \"assignment_id\": 1,\n        \"answer_media\": \"http://api.schoolhub.local:8080/api/download/activity/answer/1\"\n    },\n    {\n        \"id\": 2,\n        \"assignment_id\": 1,\n        \"answer_media\": \"http://api.schoolhub.local:8080/api/download/activity/answer/2\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/AssignmentAnswerController.php",
    "groupTitle": "Student_Classes"
  },
  {
    "type": "get",
    "url": "HOST/api/student/classes",
    "title": "get class list",
    "version": "1.0.0",
    "name": "StudentClassList",
    "description": "<p>Returns array of classes where the logged in student is currently enrolled</p>",
    "group": "Student_Classes",
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
          "content": "{\n    \"id\": 1,\n    \"first_name\": \"jayson\",\n    \"last_name\": \"barino\",\n    \"school_id\": 1,\n    \"user_type\": \"s\",\n    \"user_name\": \"jayson\",\n    \"email\": \"barinojayson@gmail.con\",\n    \"phone_number\": 111,\n    \"status\": 1,\n    \"classes\": [\n        {\n            \"id\": 1,\n            \"name\": \"English 101\",\n            \"description\": \"learn basics\",\n            \"frequency\": \"M,W,F\",\n            \"date_from\": \"2020-05-11\",\n            \"date_to\": \"2020-05-15\",\n            \"time_from\": \"09:00:00\",\n            \"time_to\": \"10:00:00\",\n            \"next_schedule\": {\n                \"from\": \"2020-05-25 09:00:00\",\n                \"to\": \"2020-05-25 10:00:00\"\n            },\n            \"subject\": {\n                \"id\": 1,\n                \"name\": \"English\"\n            },\n            \"teacher\": {\n                \"id\": 8,\n                \"first_name\": \"teacher tom\",\n                \"last_name\": \"cruz\"\n            }\n        },\n        {},\n        {}\n    ]\n}",
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
    "url": "<HOST>/api/teacher/class-activities/{id}",
    "title": "Get class activities (by schedule)",
    "version": "1.0.0",
    "name": "ClassActivities",
    "description": "<p>Returns list of class activities classified by (array of)schedules</p>",
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
          "content": "[\n    {\n        \"id\": 1,\n        \"from\": \"2020-05-15 09:00:00\",\n        \"to\": \"2020-05-15 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\"\n        },\n        \"status\": \"\",\n        \"activities\": [\n            {\n                \"id\": 1,\n                \"title\": \"English Assignment 1\",\n                \"description\": \"read it\",\n                \"activity_type\": \"class activity\",\n                \"available_from\": \"2020-05-11\",\n                \"available_to\": \"2020-05-15\",\n                \"status\": \"unpublished\",\n                \"materials\": [\n                    {\n                        \"id\": 1,\n                        \"uploaded_file\": \"\",\n                        \"resource_link\": \"http://read-english.com/basics\"\n                    },\n                    {\n                        \"id\": 1,\n                        \"uploaded_file\": \"http://link-to-uploaded-file.com/sample\",\n                        \"resource_link\": \"\"\n                    },\n            {}\n                ]\n            },\n            {}\n        ]\n    },\n    {\n        \"id\": 2,\n        \"from\": \"2020-05-18 09:00:00\",\n        \"to\": \"2020-05-18 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\"\n        },\n        \"status\": \"\",\n        \"activities\": []\n    }\n]",
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
    "url": "<HOST>/api/teacher/class/{id}",
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
          "content": "{\n    \"id\": 1,\n    \"name\": \"English 101\",\n    \"description\": \"learn basics\",\n    \"frequency\": \"M,W,F\",\n    \"date_from\": \"2020-05-11\",\n    \"date_to\": \"2020-05-15\",\n    \"time_from\": \"09:00:00\",\n    \"time_to\": \"10:00:00\",\n    \"next_schedule\": {\n        \"from\": \"2020-05-25 09:00:00\",\n        \"to\": \"2020-05-25 10:00:00\"\n    },\n    \"subject\": {\n        \"id\": 1,\n        \"name\": \"English\"\n    },\n    \"teacher\": {\n        \"id\": 8,\n        \"first_name\": \"teacher tom\",\n        \"last_name\": \"cruz\"\n    },\n    \"schedules\": [\n        {\n            \"id\": 1,\n            \"from\": \"2020-05-15 09:00:00\",\n            \"to\": \"2020-05-15 10:00:00\",\n            \"teacher\": {\n                \"id\": 8,\n                \"first_name\": \"teacher tom\",\n                \"last_name\": \"cruz\"\n            },\n            \"status\": \"\"\n        },\n        {},\n    {}\n    ],\n    \"students\": [\n        {\n            \"id\": 1,\n            \"first_name\": \"jayson\",\n            \"last_name\": \"barino\",\n            \"school_id\": 1,\n            \"user_type\": \"s\",\n            \"username\": \"jayson\",\n            \"email\": \"barinojayson@gmail.con\",\n            \"phone_number\": 111,\n            \"status\": 1\n        },\n        {},\n        {}\n    ]\n}",
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
    "url": "<HOST>/api/teacher/class-lesson-plans/{id}",
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
    "url": "<HOST>/api/teacher/class-materials/{id}",
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
    "url": "<HOST>/api/teacher/class-schedules/{id}",
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
          "content": "[\n    {\n        \"id\": 1,\n        \"from\": \"2020-05-15 09:00:00\",\n        \"to\": \"2020-05-15 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\"\n        },\n        \"status\": \"\",\n        \"materials\": [\n            {\n                \"id\": 1,\n                \"title\": \"English Writing Part 1\",\n                \"uploaded_file\": \"\",\n                \"resource_link\": \"https://sample-lesson-link.com/english-writing-part1\",\n                \"added_by\": {\n                    \"id\": 8,\n                    \"first_name\": \"teacher tom\",\n                    \"last_name\": \"cruz\"\n                }\n            },\n            {}\n        ],\n        \"activities\": [\n            {\n                \"id\": 1,\n                \"title\": \"English Assignment 1\",\n                \"description\": \"read it\",\n                \"activity_type\": \"class activity\",\n                \"available_from\": \"2020-05-11\",\n                \"available_to\": \"2020-05-15\",\n                \"status\": \"unpublished\",\n                \"materials\": [\n                    {\n                        \"id\": 1,\n                        \"uploaded_file\": \"http://link-to-uploaded-file/sample\",\n                        \"resource_link\": \"\"\n                    },\n                    {\n                        \"id\": 2,\n                        \"uploaded_file\": \"\",\n                        \"resource_link\": \"http://read-english.com/basics2\"\n                    }\n                ]\n            },\n            {}\n        ]\n    },\n    {\n        \"id\": 2,\n        \"from\": \"2020-05-18 09:00:00\",\n        \"to\": \"2020-05-18 10:00:00\",\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\"\n        },\n        \"status\": \"\",\n        \"materials\": [],\n        \"activities\": []\n    },\n    {},\n    {}\n]",
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
    "url": "<HOST>/api/teacher/class-students/{id}",
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
    "url": "HOST/api/teacher/remove/class-activity-material/{id}",
    "title": "Remove Activity Material",
    "version": "1.0.0",
    "name": "RemoveActivityMaterial",
    "description": "<p>SRemove Material of an Activity</p>",
    "group": "Teacher_Classes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Activity Material ID.</p>"
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
    "filename": "app/Http/Controllers/Api/AssignmentController.php",
    "groupTitle": "Teacher_Classes"
  },
  {
    "type": "post",
    "url": "HOST/api/teacher/remove/class-material/{id}",
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
    "url": "HOST/api/teacher/remove/class-lesson-plan/{id}",
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
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n        \"id\": 1,\n        \"name\": \"English 101\",\n        \"description\": \"learn basics\",\n        \"room_number\": 123455,\n        \"frequency\": \"M,W,F\",\n        \"date_from\": \"2020-05-11\",\n        \"date_to\": \"2020-05-15\",\n        \"time_from\": \"09:00:00\",\n        \"time_to\": \"10:00:00\",\n        \"next_schedule\": {\n            \"from\": \"2020-05-25 09:00:00\",\n            \"to\": \"2020-05-25 10:00:00\"\n            \"status\": \"DONE\"\n        },\n        \"subject\": {\n            \"id\": 1,\n            \"name\": \"English\"\n        },\n        \"teacher\": {\n            \"id\": 8,\n            \"first_name\": \"teacher tom\",\n            \"last_name\": \"cruz\"\n        }\n    },\n    {},\n    {}\n]",
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
            "type": "String",
            "optional": false,
            "field": "profile_picture",
            "description": "<p>URL of profile_picture</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "push_notification",
            "description": "<p>1 - enabled; 0 disabled</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "        {\n\t\t\t\"id\": 9,\n\t\t\t\"first_name\": \"teacher jayson\",\n\t\t\t\"last_name\": \"barino\",\n\t\t\t\"school_id\": 1,\n\t\t\t\"user_type\": \"t\",\n\t\t\t\"username\": \"tjayson\",\n\t\t\t\"email\": \"xxx@gamil.com\",\n\t\t\t\"phone_number\": 111,\n\t\t\t\"status\": 1,\n\t\t\t\"profile_picture\": \"test_profile_pic.jpg\",\n\t\t\t\"push_notification\": 1,\n\t\t\t\"email_subscription\": 0\n\t\t}",
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
