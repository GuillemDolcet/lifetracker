<?php

declare(strict_types=1);
return [
    'accepted' => 'The :attribute field must be accepted.',
    'accepted_if' => 'The :attribute field must be accepted when :other is :value.',
    'active_url' => 'The :attribute field must be a valid URL.',
    'after' => 'The :attribute field must be a date later than :date.',
    'after_or_equal' => 'The :attribute field must be a date greater than or equal to :date.',
    'alpha' => 'The :attribute field must only contain letters.',
    'alpha_dash' => 'The :attribute field should only contain letters, numbers, hyphens, and underscores.',
    'alpha_num' => 'The :attribute field should only contain letters and numbers.',
    'array' => 'The :attribute field must be an array.',
    'ascii' => 'The :attribute field should only contain alphanumeric characters and single-byte symbols.',
    'before' => 'The :attribute field must be a date older than :date.',
    'before_or_equal' => 'The :attribute field must be a date before or equal to :date.',
    'between' =>
        [
            'array' => 'The :attribute field must have between :min and :max elements.',
            'file' => 'The :attribute field must be between :min and :max kilobytes.',
            'numeric' => 'The :attribute field must be between :min and :max.',
            'string' => 'The :attribute field must be between :min and :max characters.',
        ],
    'boolean' => 'The :attribute field must be true or false.',
    'can' => 'The :attribute field contains an unauthorized value.',
    'confirmed' => 'The confirmation for the :attribute field does not match.',
    'current_password' => 'Password is incorrect.',
    'date' => 'The :attribute field must be a valid date.',
    'date_equals' => 'The :attribute field must be a date equal to :date.',
    'date_format' => 'The :attribute field must match the :format format.',
    'decimal' => 'The :attribute field must have :decimal decimals.',
    'declined' => 'The :attribute field should be rejected.',
    'declined_if' => 'The :attribute field should be rejected when :other is :value.',
    'different' => 'The :attribute and :other field must be different.',
    'digits' => 'The :attribute field must have :digits digits.',
    'digits_between' => 'The :attribute field must have between :min and :max digits.',
    'dimensions' => 'The :attribute field has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'doesnt_end_with' => 'The :attribute field must not end with one of the following : :values.',
    'doesnt_start_with' => 'The :attribute field must not begin with one of the following : :values.',
    'email' => 'The :attribute field must be a valid email address.',
    'ends_with' => 'The :attribute field must end with one of the following : :values.',
    'enum' => 'The selected field :attribute is invalid.',
    'exists' => 'The selected field :attribute is invalid.',
    'extensions' => 'The :attribute field must have one of the following extensions : :values.',
    'file' => 'The :attribute field must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' =>
        [
            'array' => 'The :attribute field must have more than :value elements.',
            'file' => 'The :attribute field must be greater than :value kilobytes.',
            'numeric' => 'The :attribute field must be greater than :value.',
            'string' => 'The :attribute field must be greater than :value characters.',
        ],
    'gte' =>
        [
            'array' => 'The :attribute field must have :value elements or more.',
            'file' => 'The :attribute field must be greater than or equal to :value kilobytes.',
            'numeric' => 'The :attribute field must be greater than or equal to :value.',
            'string' => 'The :attribute field must be greater than or equal to :value characters.',
        ],
    'hex_color' => 'The :attribute field must be a valid hexadecimal color.',
    'image' => 'The :attribute field must be an image.',
    'in' => 'The selected field :attribute is invalid.',
    'in_array' => 'The :attribute field must exist in :other.',
    'integer' => 'The :attribute field must be an integer.',
    'ip' => 'The :attribute field must be a valid IP address.',
    'ipv4' => 'The :attribute field must be a valid IPv4 address.',
    'ipv6' => 'The :attribute field must be a valid IPv6 address.',
    'json' => 'The :attribute field must be a valid JSON string.',
    'list' => 'The :attribute field must be a list.',
    'lowercase' => 'The :attribute field must be lowercase.',
    'lt' =>
        [
            'array' => 'The :attribute field must have fewer than :value elements.',
            'file' => 'The :attribute field must be less than :value kilobytes.',
            'numeric' => 'The :attribute field must be less than :value.',
            'string' => 'The :attribute field must be less than :value characters.',
        ],
    'lte' =>
        [
            'array' => 'The :attribute field must have no more than :value elements.',
            'file' => 'The :attribute field must be less than or equal to :value kilobytes.',
            'numeric' => 'The :attribute field must be less than or equal to :value.',
            'string' => 'The :attribute field must be less than or equal to :value characters.',
        ],
    'mac_address' => 'The :attribute field must be a valid MAC address.',
    'max' =>
        [
            'array' => 'The :attribute field must have no more than :max elements.',
            'file' => 'The :attribute field must not be greater than :max kilobytes.',
            'numeric' => 'The :attribute field must not be greater than :max.',
            'string' => 'The :attribute field must not be greater than :max characters.',
        ],
    'max_digits' => 'The :attribute field must be no more than :max digits.',
    'mimes' => 'The :attribute field must be a file of type : :values.',
    'mimetypes' => 'The :attribute field must be a file of type : :values.',
    'min' =>
        [
            'array' => 'The :attribute field must have at least :min elements.',
            'file' => 'The :attribute field must be at least :min kilobytes.',
            'numeric' => 'The :attribute field must be at least :min.',
            'string' => 'The :attribute field must be at least :min characters.',
        ],
    'min_digits' => 'The :attribute field must have at least :min digits.',
    'missing' => 'The :attribute field must be absent.',
    'missing_if' => 'The :attribute field must be absent when :other is :value.',
    'missing_unless' => 'The :attribute field must be absent unless :other is :value.',
    'missing_with' => 'The :attribute field must be absent when :values is present.',
    'missing_with_all' => 'The :attribute field must be absent when :values are present.',
    'multiple_of' => 'The :attribute field must be a multiple of :value.',
    'not_in' => 'The selected field :attribute is invalid.',
    'not_regex' => 'The format of the :attribute field is invalid.',
    'numeric' => 'The :attribute field must be a number.',
    'password' =>
        [
            'letters' => 'The password must contain at least one letter.',
            'mixed' => 'The password must contain at least one uppercase and one lowercase letter.',
            'numbers' => 'The password must contain at least one number.',
            'symbols' => 'The password must contain at least one symbol.',
            'uncompromised' => 'The password provided has appeared in a data breach. Please choose a different password.',
        ],
    'present' => 'The :attribute field must be present.',
    'present_if' => 'The :attribute field must be present when :other is :value.',
    'present_unless' => 'The :attribute field must be present unless :other is :value.',
    'present_with' => 'The :attribute field must be present when :values is present.',
    'present_with_all' => 'The :attribute field must be present when :values are present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The format of the :attribute field is invalid.',
    'required' => 'The :attribute field is required.',
    'required_array_keys' => 'The :attribute field must contain entries for : :values.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of the :values are present.',
    'same' => 'The :attribute and :other field must match.',
    'size' =>
        [
            'array' => 'The :attribute field must contain :size elements.',
            'file' => 'The :attribute field must be :size kilobytes.',
            'numeric' => 'The :attribute field must be :size.',
            'string' => 'The :attribute field must have :size characters.',
        ],
    'starts_with' => 'The :attribute field must begin with one of the following : :values.',
    'string' => 'The :attribute field must be a character string.',
    'timezone' => 'The :attribute field must be a valid time zone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute could not be loaded.',
    'uppercase' => 'The :attribute field must be in uppercase.',
    'url' => 'The :attribute field must be a valid URL.',
    'ulid' => 'The :attribute field must be a valid ULID.',
    'uuid' => 'The :attribute field must be a valid UUID.',
    'custom' =>
        [
            'activities' =>
                [
                    'array' => 'The activities must be of array type',
                ],
            'activities.*.date' =>
                [
                    'required_with' => 'The date cannot be empty if it has a correction date or a next inspection date',
                    'date' => 'The date is not valid',
                ],
            'activities.*.expedient_number' =>
                [
                    'max' => 'The file number must have a maximum of :max characters',
                ],
            'activities.*.max_correction_date' =>
                [
                    'after' => 'The correction date must be after the date',
                    'date' => 'The date is not valid',
                ],
            'activities.*.next_date' =>
                [
                    'after' => 'The next inspection date must be after the date',
                    'date' => 'The date is not valid',
                ],
            'activities.*.result' =>
                [
                    'in' => 'The result is not valid',
                    'numeric' => 'The result can only be numerical',
                    'required' => 'The result is mandatory',
                ],
            'activities.*.*' =>
                [
                    'exists' => 'Username does not exist',
                    'required' => 'Assigning at least one user per location is mandatory',
                ],
            'activity' =>
                [
                    'exists' => 'The activity does not exist',
                    'required' => 'The activity is mandatory',
                ],
            'city' =>
                [
                    'required' => 'The city is mandatory',
                ],
            'companies' =>
                [
                    'array' => 'Companies have to be array type',
                    'required' => 'Assigning at least one company is mandatory',
                ],
            'companies.*' =>
                [
                    'exists' => 'The company does not exist',
                ],
            'country' =>
                [
                    'required' => 'Country is required',
                ],
            'date' =>
                [
                    'date' => 'The date is not valid',
                    'required' => 'The date is mandatory',
                ],
            'description' =>
                [
                    'max' => 'The description must have a maximum of :max characters',
                    'min' => 'The description must have a minimum of :min characters',
                    'required' => 'Description is required',
                ],
            'email' =>
                [
                    'email' => 'The email is not valid',
                    'min' => 'The email must have a minimum of :min characters',
                    'required' => 'Email is mandatory',
                    'unique' => 'The email must be unique',
                ],
            'end_date' =>
                [
                    'after_or_equal' => 'The date must be after the initial date',
                    'date' => 'The date is not valid',
                ],
            'end_max_correction_date' =>
                [
                    'after_or_equal' => 'The date must be after the initial date',
                    'date' => 'The date is not valid',
                ],
            'end_next_inspection' =>
                [
                    'after_or_equal' => 'The date must be after the initial date',
                    'date' => 'The date is not valid',
                ],
            'equipment' =>
                [
                    'exists' => 'The team does not exist',
                    'required' => 'Equipment is mandatory',
                ],
            'expedient_number' =>
                [
                    'max' => 'The file number must have a maximum of :max characters',
                ],
            'first_name' =>
                [
                    'max' => 'The name must be a maximum of :max characters',
                    'min' => 'The name must be a minimum of :min characters',
                ],
            'industry_id' =>
                [
                    'numeric' => 'Industry ID can only be numeric',
                    'required' => 'Industry ID is required',
                    'unique' => 'Industry ID must be unique',
                ],
            'files' => [
                'file' => 'Some of the files are not valid.',
                'max' => 'The files must not be larger than :max kilobytes.',
                'required' => 'The files are required.',
                'mimetypes' => 'The files do not have a supported format.',
            ],
            'files.*' => [
                'file' => 'Some of the files are not valid.',
                'max' => 'The files must not be larger than :max kilobytes.',
                'required' => 'The files are required.',
                'mimetypes' => 'The files do not have a supported format.',
            ],
            'inspectionFile' => [
                'file' => 'The file is not valid.',
                'max' => 'The file must not be larger than :max kilobytes.',
                'required' => 'The file is required.',
                'mimetypes' => 'The file does not have a supported format.',
            ],
            'companyFile' => [
                'file' => 'The file is not valid.',
                'max' => 'The file must not be larger than :max kilobytes.',
                'required' => 'The file is required.',
                'mimetypes' => 'The file does not have a supported format.',
            ], 'last_name' =>
            [
                'max' => 'Last names must be a maximum of :max characters',
                'min' => 'Last names must be a minimum of :min characters',
            ],
            'location' =>
                [
                    'exists' => 'Location does not exist',
                    'required' => 'Location is mandatory',
                ],
            'managers' =>
                [
                    'exists' => 'This manager does not exist',
                    'required' => 'Assigning at least one manager per company is mandatory',
                ],
            'max_correction_date' =>
                [
                    'after' => 'The correction date must be after the date',
                    'date' => 'Correction date is not valid',
                    'required' => 'Correction date is mandatory',
                ],
            'name' =>
                [
                    'max' => 'The name must be a maximum of :max characters',
                    'min' => 'The name must be a minimum of :min characters',
                    'required' => 'The name is required',
                    'unique' => 'The name must be unique',
                ],
            'next_date' =>
                [
                    'after' => 'The next date has to be after the date',
                    'date' => 'The next date is not valid',
                    'required' => 'The next date is mandatory',
                ],
            'next_date.*' =>
                [
                    'after' => 'The next date has to be after the date',
                    'date' => 'The next date is not valid',
                    'required' => 'The next date is mandatory',
                ],
            'nif' =>
                [
                    'unique' => "The company's NIF must be unique",
                ],
            'number' =>
                [
                    'numeric' => 'The number can only be numeric',
                    'required' => 'The number is mandatory',
                ],
            'observations' =>
                [
                    'max' => 'Observations must have a maximum of :max characters',
                    'min' => 'Observations must be a minimum of :min characters',
                    'required' => 'Observations are mandatory',
                ],
            'password' =>
                [
                    'confirmed' => 'Passwords do not match',
                    'max' => 'Password must be a maximum of :max characters',
                    'min' => 'Password must be a minimum of :min characters',
                    'required' => 'Password is required',
                    'regex' => 'The password is not in the proper format',
                    'symbols' => 'The password is not in the proper format',
                ],
            'postal_code' =>
                [
                    'numeric' => 'The zip code can only be numeric',
                    'required' => 'Zip code is required',
                ],
            'result' =>
                [
                    'in' => 'The result is not valid',
                    'numeric' => 'The result can only be numerical',
                    'required' => 'The result is mandatory',
                ],
            'role' =>
                [
                    'exists' => 'The role does not exist',
                    'required' => 'The role is required',
                ],
            'start_date' =>
                [
                    'date' => 'The date is not valid',
                ],
            'start_max_correction_date' =>
                [
                    'date' => 'The date is not valid',
                ],
            'start_next_inspection' =>
                [
                    'date' => 'The date is not valid',
                ],
            'status' =>
                [
                    'in' => 'The status is not within the allowed values',
                ],
            'street' =>
                [
                    'required' => 'The street is mandatory',
                ],
            'tuv_id' =>
                [
                    'numeric' => 'TUV ID can only be numeric',
                    'required' => 'TUV ID is mandatory',
                    'unique' => 'TUV ID must be unique',
                ],
            'type' =>
                [
                    'exists' => 'Inspection type does not exist',
                    'in' => 'The type is not among the allowed values',
                    'not_in' => 'The selected type is not valid',
                    'required' => 'The type of inspection is mandatory',
                ],
            'username' =>
                [
                    'max' => 'Username must be a maximum of :max characters',
                    'min' => 'Username must be a minimum of :min characters',
                    'required' => 'Username is required',
                    'unique' => 'Username must be unique',
                ],
            'users' =>
                [
                    'array' => 'Users must be of type array',
                    'required' => 'Assigning at least one user per location is mandatory',
                ],
            'users.*' =>
                [
                    'exists' => 'Username does not exist',
                    'required' => 'Assigning at least one user per location is mandatory',
                ],
        ],
    'attributes' =>
        [],
];
