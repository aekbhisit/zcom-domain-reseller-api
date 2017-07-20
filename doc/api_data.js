define({ "api": [
  {
    "type": "post",
    "url": "/onamai/domains/DomainCreate",
    "title": "Create Domain",
    "version": "0.0.1",
    "name": "CreateDomain",
    "group": "Domain",
    "parameter": {
      "fields": {
        "Common parameter": [
          {
            "group": "Common parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>โทเคนสำหรับยืนยันตัวตน.</p>"
          }
        ],
        "Domain Information": [
          {
            "group": "Domain Information",
            "type": "String",
            "size": "255",
            "optional": false,
            "field": "domainName",
            "description": "<p>ชือโดเมน.</p>"
          },
          {
            "group": "Domain Information",
            "type": "Array[500]",
            "size": "255",
            "optional": false,
            "field": "domainNames",
            "description": "<p>ชือโดเมน สำหรับจดหลายโดเมน.</p>"
          },
          {
            "group": "Domain Information",
            "type": "String",
            "size": "3",
            "allowedValues": [
              "\"yes\"",
              "\"no\""
            ],
            "optional": false,
            "field": "preRegist",
            "description": "<p>Temporary Registration.</p>"
          },
          {
            "group": "Domain Information",
            "type": "Number",
            "size": "2",
            "optional": false,
            "field": "period",
            "description": "<p>จำนวนปีที่จดโดเมน.</p>"
          },
          {
            "group": "Domain Information",
            "type": "Array[500]",
            "size": "3",
            "optional": false,
            "field": "periods",
            "description": "<p>จำนวนปีที่จดโดเมน สำหรับจดหลายโดเมน.</p>"
          },
          {
            "group": "Domain Information",
            "type": "Array[13]",
            "size": "255",
            "optional": false,
            "field": "ns",
            "description": "<p>ข้อมูล Name server.</p>"
          },
          {
            "group": "Domain Information",
            "type": "String",
            "size": "3",
            "optional": false,
            "field": "autoRenew",
            "description": "<p>ต่ออายุอัตโนมัติ.</p>"
          },
          {
            "group": "Domain Information",
            "type": "Array[500]",
            "size": "3",
            "optional": false,
            "field": "autoRenews",
            "description": "<p>ต่ออายุอัตโนมัติ สำหรับจดหลายโดเมน.</p>"
          },
          {
            "group": "Domain Information",
            "type": "String",
            "size": "3",
            "optional": false,
            "field": "proxyflg",
            "description": "<p>ป้องกันการ Whois.</p>"
          },
          {
            "group": "Domain Information",
            "type": "Array[500]",
            "size": "3",
            "optional": false,
            "field": "proxyflgs",
            "description": "<p>ป้องกันการ Whois สำหรับจดหลายโดเมน.</p>"
          },
          {
            "group": "Domain Information",
            "type": "String",
            "size": "2",
            "allowedValues": [
              "\"SR\"",
              "\"LR\""
            ],
            "optional": false,
            "field": "srLrKeyword",
            "description": "<p>Sunrise land rush period(SR/LR).</p>"
          },
          {
            "group": "Domain Information",
            "type": "String",
            "size": "255",
            "optional": false,
            "field": "tncId",
            "description": "<p>Notification information of trademark ID.</p>"
          },
          {
            "group": "Domain Information",
            "type": "String",
            "size": "255",
            "optional": false,
            "field": "tncIds",
            "description": "<p>Notification information of trademark ID สำหรับจดหลายโดเมน.</p>"
          },
          {
            "group": "Domain Information",
            "type": "String",
            "size": "20000",
            "optional": false,
            "field": "smd",
            "description": "<p>SMD.</p>"
          },
          {
            "group": "Domain Information",
            "type": "String",
            "size": "20000",
            "allowedValues": [
              "\"yes\"",
              "\"no\""
            ],
            "optional": false,
            "field": "smds",
            "description": "<p>SMD สำหรับจดหลายโดเมน.</p>"
          },
          {
            "group": "Domain Information",
            "type": "String",
            "size": "3",
            "optional": false,
            "field": "RegistryPremium",
            "description": "<p>Registry Premium.</p>"
          },
          {
            "group": "Domain Information",
            "type": "String",
            "size": "3",
            "optional": false,
            "field": "RegistryPremiums",
            "description": "<p>Registry Premium สำหรับจดหลายโดเมน.</p>"
          }
        ],
        "Domain information extension item (additional parameter for NAME domain)": [
          {
            "group": "Domain information extension item (additional parameter for NAME domain)",
            "type": "String",
            "size": "255",
            "optional": false,
            "field": "emailForwardTo",
            "description": "<p>E-Mail as forwarding to.</p>"
          },
          {
            "group": "Domain information extension item (additional parameter for NAME domain)",
            "type": "Array[500]",
            "size": "255",
            "optional": false,
            "field": "emailForwardTos",
            "description": "<p>E-Mail as forwarding to สำหรับจดหลายโดเมน.</p>"
          }
        ],
        "Domain information extension item (additional parameter for TEL domain)": [
          {
            "group": "Domain information extension item (additional parameter for TEL domain)",
            "type": "String",
            "size": "7",
            "allowedValues": [
              "\"Legal\"",
              "\"Natural\""
            ],
            "optional": false,
            "field": "whoisType",
            "description": "<p>Whois information organization type.</p>"
          },
          {
            "group": "Domain information extension item (additional parameter for TEL domain)",
            "type": "String",
            "size": "3",
            "allowedValues": [
              "\"Yes\"",
              "\"No\""
            ],
            "optional": false,
            "field": "publish",
            "description": "<p>Whois Propriety.</p>"
          }
        ],
        "CED information (additional parameter for ASIA domain)": [
          {
            "group": "CED information (additional parameter for ASIA domain)",
            "type": "String",
            "size": "3",
            "optional": false,
            "field": "primaryCed",
            "description": "<p>Responsible role(Reg/Adm/Tec/Bil).</p>"
          },
          {
            "group": "CED information (additional parameter for ASIA domain)",
            "type": "String",
            "size": "2",
            "optional": false,
            "field": "cedCcLocality",
            "description": "<p>Country code(ISO3166 2 digits).</p>"
          },
          {
            "group": "CED information (additional parameter for ASIA domain)",
            "type": "String",
            "size": "20",
            "optional": false,
            "field": "cedState",
            "description": "<p>Prefectures(JISX0401|Optional).</p>"
          },
          {
            "group": "CED information (additional parameter for ASIA domain)",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "cedCity",
            "description": "<p>City.</p>"
          },
          {
            "group": "CED information (additional parameter for ASIA domain)",
            "type": "String",
            "size": "14",
            "optional": false,
            "field": "cedLegalEntityType",
            "description": "<p>Organization type.</p>"
          },
          {
            "group": "CED information (additional parameter for ASIA domain)",
            "type": "String",
            "size": "22",
            "optional": false,
            "field": "cedForm",
            "description": "<p>Method to prove.</p>"
          },
          {
            "group": "CED information (additional parameter for ASIA domain)",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "cedIdentificationNumber",
            "description": "<p>Proven number（Passport No. etc）.</p>"
          },
          {
            "group": "CED information (additional parameter for ASIA domain)",
            "type": "String",
            "size": "128",
            "optional": false,
            "field": "cedRemark1",
            "description": "<p>Organization name(other).</p>"
          },
          {
            "group": "CED information (additional parameter for ASIA domain)",
            "type": "String",
            "size": "128",
            "optional": false,
            "field": "cedRemark2",
            "description": "<p>Method to prove(other).</p>"
          }
        ],
        "Registrant Information": [
          {
            "group": "Registrant Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "regFname",
            "description": "<p>ชือผู้จดโดเมน.</p>"
          },
          {
            "group": "Registrant Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "regLname",
            "description": "<p>นามสกุลผู้จดโดเมน.</p>"
          },
          {
            "group": "Registrant Information",
            "type": "String",
            "size": "1",
            "allowedValues": [
              "\"I\"",
              "\"R\""
            ],
            "optional": false,
            "field": "regRole",
            "description": "<p>ประเภทบุคคล I : individual / R : organization.</p>"
          },
          {
            "group": "Registrant Information",
            "type": "String",
            "size": "100",
            "optional": false,
            "field": "regOrganization",
            "description": "<p>บริษัท.</p>"
          },
          {
            "group": "Registrant Information",
            "type": "String",
            "size": "2",
            "optional": false,
            "field": "regCc",
            "description": "<p>ประเทศ (2digit ISO3166).</p>"
          },
          {
            "group": "Registrant Information",
            "type": "String",
            "size": "16",
            "optional": false,
            "field": "regPc",
            "description": "<p>รหัสไปรษณีย์.</p>"
          },
          {
            "group": "Registrant Information",
            "type": "String",
            "size": "20",
            "optional": false,
            "field": "regSp",
            "description": "<p>จังหวัด (2digit JISX0401).</p>"
          },
          {
            "group": "Registrant Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "regCity",
            "description": "<p>เมือง.</p>"
          },
          {
            "group": "Registrant Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "regStreet1",
            "description": "<p>ที่อยู่.</p>"
          },
          {
            "group": "Registrant Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "regStreet2",
            "description": "<p>ที่อยู่.</p>"
          },
          {
            "group": "Registrant Information",
            "type": "String",
            "size": "20",
            "optional": false,
            "field": "regPhone",
            "description": "<p>เบอร์มือถือ.</p>"
          },
          {
            "group": "Registrant Information",
            "type": "String",
            "size": "20",
            "optional": false,
            "field": "regFax",
            "description": "<p>เบอร์แฟกซ์.</p>"
          },
          {
            "group": "Registrant Information",
            "type": "String",
            "size": "100",
            "optional": false,
            "field": "regEmail",
            "description": "<p>อีเมล์.</p>"
          }
        ],
        "Registrant extension information (additional parameter for US domain)": [
          {
            "group": "Registrant extension information (additional parameter for US domain)",
            "type": "String",
            "size": "5",
            "optional": false,
            "field": "regNexusCategory",
            "description": "<p>Relationship with the US.</p>"
          },
          {
            "group": "Registrant extension information (additional parameter for US domain)",
            "type": "String",
            "size": "2",
            "optional": false,
            "field": "regNationality",
            "description": "<p>Nationality(ISO3166 2 digits).</p>"
          },
          {
            "group": "Registrant extension information (additional parameter for US domain)",
            "type": "String",
            "size": "5",
            "optional": false,
            "field": "regAppPurpose",
            "description": "<p>Purpose of use.</p>"
          }
        ],
        "Registrant extension information (general-purpose JP / additional parameter for attribute type JP domain)": [
          {
            "group": "Registrant extension information (general-purpose JP / additional parameter for attribute type JP domain)",
            "type": "String",
            "size": "75",
            "optional": false,
            "field": "regFnameMl",
            "description": "<p>First name Japanese.</p>"
          },
          {
            "group": "Registrant extension information (general-purpose JP / additional parameter for attribute type JP domain)",
            "type": "String",
            "size": "75",
            "optional": false,
            "field": "regLnameMl",
            "description": "<p>Last name Japanese.</p>"
          },
          {
            "group": "Registrant extension information (general-purpose JP / additional parameter for attribute type JP domain)",
            "type": "String",
            "size": "200",
            "optional": false,
            "field": "regOrganizationMl",
            "description": "<p>Individual / Organization name Japanese.</p>"
          },
          {
            "group": "Registrant extension information (general-purpose JP / additional parameter for attribute type JP domain)",
            "type": "String",
            "size": "75",
            "optional": false,
            "field": "regCityMl",
            "description": "<p>City Japanese.</p>"
          },
          {
            "group": "Registrant extension information (general-purpose JP / additional parameter for attribute type JP domain)",
            "type": "String",
            "size": "75",
            "optional": false,
            "field": "regStreet1Ml",
            "description": "<p>Street1 Japanese.</p>"
          },
          {
            "group": "Registrant extension information (general-purpose JP / additional parameter for attribute type JP domain)",
            "type": "String",
            "size": "75",
            "optional": false,
            "field": "regStreet2Ml",
            "description": "<p>Street2  Japanese.</p>"
          },
          {
            "group": "Registrant extension information (general-purpose JP / additional parameter for attribute type JP domain)",
            "type": "String",
            "size": "255",
            "optional": false,
            "field": "regDivisionMl",
            "description": "<p>Division name Japanese.</p>"
          }
        ],
        "Admin Contact Information": [
          {
            "group": "Admin Contact Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "admFname",
            "description": "<p>ชือผู้จดโดเมน.</p>"
          },
          {
            "group": "Admin Contact Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "admLname",
            "description": "<p>นามสกุลผู้จดโดเมน.</p>"
          },
          {
            "group": "Admin Contact Information",
            "type": "String",
            "size": "1",
            "allowedValues": [
              "\"I\"",
              "\"R\""
            ],
            "optional": false,
            "field": "admRole",
            "description": "<p>ประเภทบุคคล I : individual / R : organization.</p>"
          },
          {
            "group": "Admin Contact Information",
            "type": "String",
            "size": "100",
            "optional": false,
            "field": "admOrganization",
            "description": "<p>บริษัท.</p>"
          },
          {
            "group": "Admin Contact Information",
            "type": "String",
            "size": "2",
            "optional": false,
            "field": "admCc",
            "description": "<p>ประเทศ (2digit ISO3166).</p>"
          },
          {
            "group": "Admin Contact Information",
            "type": "String",
            "size": "16",
            "optional": false,
            "field": "admPc",
            "description": "<p>รหัสไปรษณีย์.</p>"
          },
          {
            "group": "Admin Contact Information",
            "type": "String",
            "size": "20",
            "optional": false,
            "field": "admSp",
            "description": "<p>จังหวัด (2digit JISX0401).</p>"
          },
          {
            "group": "Admin Contact Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "admCity",
            "description": "<p>เมือง.</p>"
          },
          {
            "group": "Admin Contact Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "admStreet1",
            "description": "<p>ที่อยู่.</p>"
          },
          {
            "group": "Admin Contact Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "admStreet2",
            "description": "<p>ที่อยู่.</p>"
          },
          {
            "group": "Admin Contact Information",
            "type": "String",
            "size": "20",
            "optional": false,
            "field": "admPhone",
            "description": "<p>เบอร์มือถือ.</p>"
          },
          {
            "group": "Admin Contact Information",
            "type": "String",
            "size": "20",
            "optional": false,
            "field": "admFax",
            "description": "<p>เบอร์แฟกซ์.</p>"
          },
          {
            "group": "Admin Contact Information",
            "type": "String",
            "size": "100",
            "optional": false,
            "field": "admEmail",
            "description": "<p>อีเมล์.</p>"
          }
        ],
        "Tech Contact Information": [
          {
            "group": "Tech Contact Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "tecFname",
            "description": "<p>ชือผู้จดโดเมน.</p>"
          },
          {
            "group": "Tech Contact Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "tecLname",
            "description": "<p>นามสกุลผู้จดโดเมน.</p>"
          },
          {
            "group": "Tech Contact Information",
            "type": "String",
            "size": "1",
            "allowedValues": [
              "\"I\"",
              "\"R\""
            ],
            "optional": false,
            "field": "tecRole",
            "description": "<p>ประเภทบุคคล I : individual / R : organization.</p>"
          },
          {
            "group": "Tech Contact Information",
            "type": "String",
            "size": "100",
            "optional": false,
            "field": "tecOrganization",
            "description": "<p>บริษัท.</p>"
          },
          {
            "group": "Tech Contact Information",
            "type": "String",
            "size": "2",
            "optional": false,
            "field": "tecCc",
            "description": "<p>ประเทศ (2digit ISO3166).</p>"
          },
          {
            "group": "Tech Contact Information",
            "type": "String",
            "size": "16",
            "optional": false,
            "field": "tecPc",
            "description": "<p>รหัสไปรษณีย์.</p>"
          },
          {
            "group": "Tech Contact Information",
            "type": "String",
            "size": "20",
            "optional": false,
            "field": "tecSp",
            "description": "<p>จังหวัด (2digit JISX0401).</p>"
          },
          {
            "group": "Tech Contact Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "tecCity",
            "description": "<p>เมือง.</p>"
          },
          {
            "group": "Tech Contact Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "tecStreet1",
            "description": "<p>ที่อยู่.</p>"
          },
          {
            "group": "Tech Contact Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "tectreet2",
            "description": "<p>ที่อยู่.</p>"
          },
          {
            "group": "Tech Contact Information",
            "type": "String",
            "size": "20",
            "optional": false,
            "field": "tecPhone",
            "description": "<p>เบอร์มือถือ.</p>"
          },
          {
            "group": "Tech Contact Information",
            "type": "String",
            "size": "20",
            "optional": false,
            "field": "tecFax",
            "description": "<p>เบอร์แฟกซ์.</p>"
          },
          {
            "group": "Tech Contact Information",
            "type": "String",
            "size": "100",
            "optional": false,
            "field": "tecEmail",
            "description": "<p>อีเมล์.</p>"
          }
        ],
        "Techf extension information (additional parameter for attribute type JP domain)": [
          {
            "group": "Techf extension information (additional parameter for attribute type JP domain)",
            "type": "String",
            "size": "75",
            "optional": false,
            "field": "tecFnameMl",
            "description": "<p>First name Japanese.</p>"
          },
          {
            "group": "Techf extension information (additional parameter for attribute type JP domain)",
            "type": "String",
            "size": "75",
            "optional": false,
            "field": "tecLnameMl",
            "description": "<p>Last name Japanese.</p>"
          },
          {
            "group": "Techf extension information (additional parameter for attribute type JP domain)",
            "type": "String",
            "size": "200",
            "optional": false,
            "field": "tecOrganizationMl",
            "description": "<p>Individual / Organization name Japanese.</p>"
          },
          {
            "group": "Techf extension information (additional parameter for attribute type JP domain)",
            "type": "String",
            "size": "75",
            "optional": false,
            "field": "tecCityMl",
            "description": "<p>City Japanese.</p>"
          },
          {
            "group": "Techf extension information (additional parameter for attribute type JP domain)",
            "type": "String",
            "size": "75",
            "optional": false,
            "field": "tecStreet1Ml",
            "description": "<p>Street1 Japanese.</p>"
          },
          {
            "group": "Techf extension information (additional parameter for attribute type JP domain)",
            "type": "String",
            "size": "75",
            "optional": false,
            "field": "tecStreet2Ml",
            "description": "<p>Street2  Japanese.</p>"
          },
          {
            "group": "Techf extension information (additional parameter for attribute type JP domain)",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "tecDivision",
            "description": "<p>Division name Japanese.</p>"
          },
          {
            "group": "Techf extension information (additional parameter for attribute type JP domain)",
            "type": "String",
            "size": "255",
            "optional": false,
            "field": "tecDivisionMl",
            "description": "<p>Division name Japanese.</p>"
          },
          {
            "group": "Techf extension information (additional parameter for attribute type JP domain)",
            "type": "String",
            "size": "100",
            "optional": false,
            "field": "tecTitle",
            "description": "<p>Role.</p>"
          },
          {
            "group": "Techf extension information (additional parameter for attribute type JP domain)",
            "type": "String",
            "size": "255",
            "optional": false,
            "field": "tecTitleMl",
            "description": "<p>Role in Japaneses.</p>"
          }
        ],
        "Billing Contact Information": [
          {
            "group": "Billing Contact Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "bilFname",
            "description": "<p>ชือผู้จดโดเมน.</p>"
          },
          {
            "group": "Billing Contact Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "bilLname",
            "description": "<p>นามสกุลผู้จดโดเมน.</p>"
          },
          {
            "group": "Billing Contact Information",
            "type": "String",
            "size": "1",
            "allowedValues": [
              "\"I\"",
              "\"R\""
            ],
            "optional": false,
            "field": "bilRole",
            "description": "<p>ประเภทบุคคล I : individual / R : organization.</p>"
          },
          {
            "group": "Billing Contact Information",
            "type": "String",
            "size": "100",
            "optional": false,
            "field": "bilOrganization",
            "description": "<p>บริษัท.</p>"
          },
          {
            "group": "Billing Contact Information",
            "type": "String",
            "size": "2",
            "optional": false,
            "field": "bilCc",
            "description": "<p>ประเทศ (2digit ISO3166).</p>"
          },
          {
            "group": "Billing Contact Information",
            "type": "String",
            "size": "16",
            "optional": false,
            "field": "bilPc",
            "description": "<p>รหัสไปรษณีย์.</p>"
          },
          {
            "group": "Billing Contact Information",
            "type": "String",
            "size": "20",
            "optional": false,
            "field": "bilSp",
            "description": "<p>จังหวัด (2digit JISX0401).</p>"
          },
          {
            "group": "Billing Contact Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "bilCity",
            "description": "<p>เมือง.</p>"
          },
          {
            "group": "Billing Contact Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "bilStreet1",
            "description": "<p>ที่อยู่.</p>"
          },
          {
            "group": "Billing Contact Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "biltreet2",
            "description": "<p>ที่อยู่.</p>"
          },
          {
            "group": "Billing Contact Information",
            "type": "String",
            "size": "20",
            "optional": false,
            "field": "bilPhone",
            "description": "<p>เบอร์มือถือ.</p>"
          },
          {
            "group": "Billing Contact Information",
            "type": "String",
            "size": "20",
            "optional": false,
            "field": "bilFax",
            "description": "<p>เบอร์แฟกซ์.</p>"
          },
          {
            "group": "Billing Contact Information",
            "type": "String",
            "size": "100",
            "optional": false,
            "field": "bilEmail",
            "description": "<p>อีเมล์.</p>"
          }
        ],
        "Public Contact Information (for JP domain)": [
          {
            "group": "Public Contact Information (for JP domain)",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "agoFname",
            "description": "<p>ชือผู้จดโดเมน.</p>"
          },
          {
            "group": "Public Contact Information (for JP domain)",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "agoLname",
            "description": "<p>นามสกุลผู้จดโดเมน.</p>"
          },
          {
            "group": "Public Contact Information (for JP domain)",
            "type": "String",
            "size": "1",
            "allowedValues": [
              "\"I\"",
              "\"R\""
            ],
            "optional": false,
            "field": "agoRole",
            "description": "<p>ประเภทบุคคล I : individual / R : organization.</p>"
          },
          {
            "group": "Public Contact Information (for JP domain)",
            "type": "String",
            "size": "100",
            "optional": false,
            "field": "agoOrganization",
            "description": "<p>บริษัท.</p>"
          },
          {
            "group": "Public Contact Information (for JP domain)",
            "type": "String",
            "size": "2",
            "optional": false,
            "field": "agoCc",
            "description": "<p>ประเทศ (2digit ISO3166).</p>"
          },
          {
            "group": "Public Contact Information (for JP domain)",
            "type": "String",
            "size": "16",
            "optional": false,
            "field": "agoPc",
            "description": "<p>รหัสไปรษณีย์.</p>"
          },
          {
            "group": "Public Contact Information (for JP domain)",
            "type": "String",
            "size": "20",
            "optional": false,
            "field": "agoSp",
            "description": "<p>จังหวัด (2digit JISX0401).</p>"
          },
          {
            "group": "Public Contact Information (for JP domain)",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "agoCity",
            "description": "<p>เมือง.</p>"
          },
          {
            "group": "Public Contact Information (for JP domain)",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "agoStreet1",
            "description": "<p>ที่อยู่.</p>"
          },
          {
            "group": "Public Contact Information (for JP domain)",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "agotreet2",
            "description": "<p>ที่อยู่.</p>"
          },
          {
            "group": "Public Contact Information (for JP domain)",
            "type": "String",
            "size": "20",
            "optional": false,
            "field": "agoPhone",
            "description": "<p>เบอร์มือถือ.</p>"
          },
          {
            "group": "Public Contact Information (for JP domain)",
            "type": "String",
            "size": "20",
            "optional": false,
            "field": "agoFax",
            "description": "<p>เบอร์แฟกซ์.</p>"
          },
          {
            "group": "Public Contact Information (for JP domain)",
            "type": "String",
            "size": "100",
            "optional": false,
            "field": "agoEmail",
            "description": "<p>อีเมล์.</p>"
          },
          {
            "group": "Public Contact Information (for JP domain)",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "agoFnameMl",
            "description": "<p>First name Japanese.</p>"
          },
          {
            "group": "Public Contact Information (for JP domain)",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "agoLnameMl",
            "description": "<p>Last name Japanese.</p>"
          },
          {
            "group": "Public Contact Information (for JP domain)",
            "type": "String",
            "size": "100",
            "optional": false,
            "field": "agoOrganizationMl",
            "description": "<p>Individual / Organization name Japanese.</p>"
          },
          {
            "group": "Public Contact Information (for JP domain)",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "agoCityMl",
            "description": "<p>City Japanese.</p>"
          },
          {
            "group": "Public Contact Information (for JP domain)",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "agoStreet1Ml",
            "description": "<p>Street1 Japanese.</p>"
          },
          {
            "group": "Public Contact Information (for JP domain)",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "agoStreet2Ml",
            "description": "<p>Street2  Japanese.</p>"
          }
        ],
        "Organization Information": [
          {
            "group": "Organization Information",
            "type": "String",
            "size": "100",
            "optional": false,
            "field": "orgOrganization",
            "description": "<p>Organization name.</p>"
          },
          {
            "group": "Organization Information",
            "type": "String",
            "size": "200",
            "optional": false,
            "field": "orgOrganizationMl",
            "description": "<p>Organization name in japanese.</p>"
          },
          {
            "group": "Organization Information",
            "type": "String",
            "size": "255",
            "optional": false,
            "field": "orgOrganizationMlKana",
            "description": "<p>Organization name in japanese with subtitle.</p>"
          },
          {
            "group": "Organization Information",
            "type": "String",
            "size": "3",
            "optional": false,
            "field": "orgOrganizationType",
            "description": "<p>Organization type.</p>"
          },
          {
            "group": "Organization Information",
            "type": "String",
            "size": "2",
            "optional": false,
            "field": "orgCc",
            "description": "<p>Country code (2digit ISO3166).</p>"
          },
          {
            "group": "Organization Information",
            "type": "String",
            "size": "16",
            "optional": false,
            "field": "orgPc",
            "description": "<p>Postal code.</p>"
          },
          {
            "group": "Organization Information",
            "type": "String",
            "size": "47",
            "optional": false,
            "field": "orgSp",
            "description": "<p>State or Prefecture (2digit JISX0401).</p>"
          },
          {
            "group": "Organization Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "orgCity",
            "description": "<p>City.</p>"
          },
          {
            "group": "Organization Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "orgStreet1",
            "description": "<p>Street1.</p>"
          },
          {
            "group": "Organization Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "orgStreet2",
            "description": "<p>Street2.</p>"
          },
          {
            "group": "Organization Information",
            "type": "String",
            "size": "75",
            "optional": false,
            "field": "orgCityML",
            "description": "<p>City in Japanese.</p>"
          },
          {
            "group": "Organization Information",
            "type": "String",
            "size": "75",
            "optional": false,
            "field": "orgStreet1Ml",
            "description": "<p>Street1 Japanese.</p>"
          },
          {
            "group": "Organization Information",
            "type": "String",
            "size": "75",
            "optional": false,
            "field": "orgStreet2Ml",
            "description": "<p>Street2 Japanese.</p>"
          },
          {
            "group": "Organization Information",
            "type": "String",
            "size": "10",
            "optional": false,
            "field": "orgRegistrationDate",
            "description": "<p>Register Date (yyyy/mm/dd).</p>"
          },
          {
            "group": "Organization Information",
            "type": "String",
            "size": "255",
            "optional": false,
            "field": "orgRegistrationAddress",
            "description": "<p>Register Address.</p>"
          },
          {
            "group": "Organization Information",
            "type": "String",
            "size": "50",
            "optional": false,
            "field": "orgRepresentName",
            "description": "<p>President name.</p>"
          },
          {
            "group": "Organization Information",
            "type": "String",
            "size": "75",
            "optional": false,
            "field": "orgRepresentNameMl",
            "description": "<p>President name in japanese.</p>"
          },
          {
            "group": "Organization Information",
            "type": "String",
            "size": "255",
            "optional": false,
            "field": "orgTitleMl",
            "description": "<p>Role in Japaneses.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "$url = 'https://services.shopup.com/onamai/domains/DomainCreate';\n$ch = curl_init();\ncurl_setopt($ch, CURLOPT_URL, $url);\ncurl_setopt($ch, CURLOPT_RETURNTRANSFER, true);\ncurl_setopt($ch, CURLOPT_POST, true);\n$post_array = array(\n 'token'=>'Token',\n 'domainName'=>'simple.com',\n 'period'=>'1',\n 'autoRenew'=>'no',\n 'proxyflg'=>'no',\n 'ns'=>array(\n  'ns1.netdesignhost.com',\n  'ns2.netdesignhost.com'\n ),\n 'regFname'=>'Sathaporn',\n 'regLname'=>'Sukrammi',\n 'regRole'=>'I',\n 'regOrganization'=>'Shopup',\n 'regCc'=>'TH',\n 'regPc'=>'Bangkok',\n 'regSp'=>'Bangkok',\n 'regCity'=>'Bangkok',\n 'regStreet1'=>'891 soi pachanarumit',\n 'regPhone'=>'0853574703',\n 'regEmail'=>'sathapornsukrammi@gmail.com',\n 'admFname'=>'Sathaporn',\n 'admLname'=>'Sukrammi',\n 'admRole'=>'I',\n 'admOrganization'=>'Shopup',\n 'admCc'=>'TH',\n 'admPc'=>'Bangkok',\n 'admSp'=>'Bangkok',\n 'admCity'=>'Bangkok',\n 'admStreet1'=>'891 soi pachanarumit',\n 'admPhone'=>'0853574703',\n 'admEmail'=>'sathapornsukrammi@gmail.com',\n 'tecFname'=>'Sathaporn',\n 'tecLname'=>'Sukrammi',\n 'tecRole'=>'I',\n 'tecOrganization'=>'Shopup',\n 'tecCc'=>'TH',\n 'tecPc'=>'Bangkok',\n 'tecSp'=>'Bangkok',\n 'tecCity'=>'Bangkok',\n 'tecStreet1'=>'891 soi pachanarumit',\n 'tecPhone'=>'0853574703',\n 'tecEmail'=>'sathapornsukrammi@gmail.com',\n 'bilFname'=>'Sathaporn',\n 'bilLname'=>'Sukrammi',\n 'bilRole'=>'I',\n 'bilOrganization'=>'Shopup',\n 'bilCc'=>'TH',\n 'bilPc'=>'Bangkok',\n 'bilSp'=>'Bangkok',\n 'bilCity'=>'Bangkok',\n 'bilStreet1'=>'891 soi pachanarumit',\n 'bilPhone'=>'0853574703',\n 'bilEmail'=>'sathapornsukrammi@gmail.com',\n);\n$post_array = http_build_query($post_array);\ncurl_setopt($ch, CURLOPT_POSTFIELDS, $post_array);\n$output = curl_exec($ch);",
        "type": "curl"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "responseBean",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--[result]",
            "description": "<p>Rabel for command result</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "----[actionType]",
            "description": "<p>Command type</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "----[resultCode]",
            "description": "<p>Processing result code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "----[resultMsg]",
            "description": "<p>Processing result message</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "----[receiptNo]",
            "description": "<p>Regist No</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--[body]",
            "description": "<p>A rabel for identifying domain information</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "----[entry]",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "------[value]",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------domainId",
            "description": "<p>domain id</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------domainName",
            "description": "<p>domain name</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------pendingId",
            "description": "<p>Pending query id</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"responseBean\": {\n \"id\": \"123456\",\n \"result\": {\n  \"actionType\": \"DomainCreate\",\n  \"resultCode\": \"11000\",\n  \"resultMsg\": \"Command receipted successfully.\",\n  \"receiptNo\": \"20130617144810792754203E\",\n  \"terminate\": \"no\"\n },\n \"details\": {\n  \"list\": [\n  {\n   \"id\": \"123456789\",\n   \"result\": {\n    \"actionType\": \"DomainCreate\",\n    \"resultCode\": \"11000\",\n    \"resultMsg\": \"Command receipted successfully.\",\n    \"receiptNo\": \"20130617144810792754203E-OB00\",\n    \"object\": {\n     \"key\": \"domainName\",\n     \"value\": \"sample.ac.jp\"\n    },\n    \"terminate\": \"no\"\n   },\n   \"subResult\": {\n    \"list\": [\n    {\n     \"actionType\": \"ContactCreate\",\n     \"resultCode\": \"1001\",\n     \"resultMsg\": \"Dummy ContactCreate successfully.\",\n     \"receiptNo\": \"20130617144810792754203E-OB00-C10\",\n     \"main\": false\n    },\n    {\n     \"actionType\": \"ContactCreate\",\n     \"resultCode\": \"1001\",\n     \"resultMsg\": \"Dummy ContactCreate successfully.\",\n     \"receiptNo\": \"20130617144810792754203E-OB00-C20\",\n     \"main\": false\n    },\n    {\n     \"actionType\": \"ContactCreate\",\n     \"resultCode\": \"1001\",\n     \"resultMsg\": \"Dummy ContactCreate successfully.\",\n     \"receiptNo\": \"20130617144810792754203E-OB00-C30\",\n     \"main\": false\n    },\n    {\n     \"actionType\": \"ContactCreate\",\n     \"resultCode\": \"1001\",\n     \"resultMsg\": \"Dummy ContactCreate successfully.\",\n     \"receiptNo\": \"20130617144810792754203E-OB00-C40\",\n     \"main\": false\n    },\n    {\n     \"actionType\": \"ContactCreate\",\n     \"resultCode\": \"1001\",\n     \"resultMsg\": \"Dummy ContactCreate successfully.\",\n     \"receiptNo\": \"20130617144810792754203E-OB00-C60\",\n     \"main\": false\n    },\n    {\n     \"actionType\": \"DomainCreate\",\n     \"resultCode\": \"1001\",\n     \"resultMsg\": \"Transmission of E-mail successfully.\",\n     \"receiptNo\": \"20130617144810792754203E-OB00\",\n     \"main\": true\n    }\n   ]\n  },\n  \"body\": {\n   \"list\": [\n    {\n     \"key\": \"domainid\",\n     \"value\": \"1234567\"\n    },\n    {\n     \"key\": \"domainname\",\n     \"value\": \"sample.ac.jp\"\n    },\n    {\n     \"key\": \"expirationdate\"\n    },\n    {\n     \"key\": \"pendingid\",\n     \"value\": \"12345678\"\n    }\n   ]\n  }\n }\n]\n }\n}}",
          "type": "json"
        }
      ]
    },
    "filename": "myapp/onamae.js",
    "groupTitle": "Domain"
  },
  {
    "type": "post",
    "url": "/onamai/domains/DomainCheck",
    "title": "Domain Check",
    "version": "0.0.1",
    "name": "DomainCheck",
    "group": "Domain",
    "examples": [
      {
        "title": "Example usage:",
        "content": "$url = 'https://services.shopup.com/onamai/domains/DomainCheck';\n$ch = curl_init();\ncurl_setopt($ch, CURLOPT_URL, $url);\ncurl_setopt($ch, CURLOPT_RETURNTRANSFER, true);\ncurl_setopt($ch, CURLOPT_POST, true);\n$post_array = array(\n 'token'=>'Token',\n 'domain'=>'sample',\n 'tld'=>'com'\n);\n$post_array = http_build_query($post_array);\ncurl_setopt($ch, CURLOPT_POSTFIELDS, $post_array);\n$output = curl_exec($ch);",
        "type": "curl"
      }
    ],
    "parameter": {
      "fields": {
        "Common parameter": [
          {
            "group": "Common parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token.</p>"
          },
          {
            "group": "Common parameter",
            "type": "String",
            "size": "255",
            "optional": false,
            "field": "domain",
            "description": "<p>Domain Name.</p>"
          },
          {
            "group": "Common parameter",
            "type": "String[25]",
            "size": "255",
            "optional": false,
            "field": "tld",
            "description": "<p>TLD.</p>"
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
            "field": "responseBean",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "result",
            "description": "<p>Rabel for command result.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "actionType",
            "description": "<p>Command type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "resultCode",
            "description": "<p>Processing result code.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "resultMsg",
            "description": "<p>Processing result message.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "receiptNo",
            "description": "<p>Regist No.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "body",
            "description": "<p>A rabel for identifying domain information.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "key",
            "description": "<p>Domain name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "value",
            "description": "<p>Result (Registered:0/Available:1/Disapproval:2/Timeout:3/Email notification:5/Backorder:6/Auction:7).</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": " {\"responseBean\": {\n  \"result\": {\n    \"actionType\": \"DomainCheck\",\n    \"resultCode\": \"10000\",\n    \"resultMsg\": \"Command completed successfully.\",\n    \"receiptNo\": \"20130617114830801217203E\",\n    \"terminate\": \"no\"\n  },\n  \"body\": {\n    \"list\": [\n      {\n        \"key\": \"sample.com\",\n        \"value\": \"1\"\n      },\n      {\n        \"key\": \"sample.org\",\n        \"value\": \"1\"\n      },\n      {\n        \"key\": \"sample.net\",\n        \"value\": \"3\"\n      }\n    ]\n  }\n}}",
          "type": "json"
        }
      ]
    },
    "filename": "myapp/onamae.js",
    "groupTitle": "Domain"
  },
  {
    "type": "post",
    "url": "/onamai/domains/DomainInfo",
    "title": "Domain Info",
    "version": "0.0.1",
    "name": "DomainInfo",
    "group": "Domain",
    "parameter": {
      "fields": {
        "Common parameter": [
          {
            "group": "Common parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token.</p>"
          },
          {
            "group": "Common parameter",
            "type": "String",
            "size": "255",
            "optional": false,
            "field": "domainName",
            "description": "<p>Domain Name.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "$url = 'https://services.shopup.com/onamai/domains/DomainInfo';\n$ch = curl_init();\ncurl_setopt($ch, CURLOPT_URL, $url);\ncurl_setopt($ch, CURLOPT_RETURNTRANSFER, true);\ncurl_setopt($ch, CURLOPT_POST, true);\n$post_array = array(\n 'token'=>'Token',\n 'domainName'=>'Domainname'\n);\n$post_array = http_build_query($post_array);\ncurl_setopt($ch, CURLOPT_POSTFIELDS, $post_array);\n$output = curl_exec($ch);",
        "type": "curl"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "responseBean",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--[result]",
            "description": "<p>Rabel for command result.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "----actionType",
            "description": "<p>Command type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "----resultCode",
            "description": "<p>Processing result code.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "----resultMsg",
            "description": "<p>Processing result message.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "----receiptNo",
            "description": "<p>Regist No.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--[body]",
            "description": "<p>A rabel for identifying domain information.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "----entry",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------key:domainid",
            "description": "<p>value:domain ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------key:domainname",
            "description": "<p>value:domain name</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------key:domainnameml",
            "description": "<p>value:domain name(Japanese)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------key:domainkana",
            "description": "<p>value:in Japanese &quot;kana&quot;</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------key:expirationdate",
            "description": "<p>value:Expiration Date (&quot;yyyy/MM/dd HH:mm:ss&quot;)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------key:renewaldeadline",
            "description": "<p>value:Due(deadline) date of renewal (&quot;yyyy/MM/dd&quot;)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------key:authcode",
            "description": "<p>value:Domain Authcode</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------key:status",
            "description": "<p>value:Domain Status</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------key:autorenew",
            "description": "<p>value:Auto renew(yes/no)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------key:whoisproxy",
            "description": "<p>value:whoisproxy(yes/no)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------key:primaryced",
            "description": "<p>value:Responsible person (Reg/Adm/Tec/Bil)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------key:emailforwardto",
            "description": "<p>value:Forwarding Email Address</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------key:whoistype",
            "description": "<p>value: .TEL Whois Organization type</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------key:publish",
            "description": "<p>value: .TEL permission of whois</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------key:createddate",
            "description": "<p>value: Registar date (&quot;yyyy/MM/dd HH:mm:ss&quot;)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------key:lastupdatedate",
            "description": "<p>value: Latest renewal date(&quot;yyyy/MM/dd HH:mm:ss&quot;)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------key:ns",
            "description": "<p>value(list): NameServer</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------key:host",
            "description": "<p>value(list): Host Name</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "------------[hostBean]",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------hostname",
            "description": "<p>ChildNameServer</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------ipv",
            "description": "<p>IP address(ipv4)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------ipv6",
            "description": "<p>IP address(ipv6)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------key:contact",
            "description": "<p>value(list): contact information</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "------------[contact]",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "------------type",
            "description": "<p>(属性) \tcontact type</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------id",
            "description": "<p>contact ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------regHandle",
            "description": "<p>RegId (use in JP domain name)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------status",
            "description": "<p>status</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------fname",
            "description": "<p>Given name</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------lname",
            "description": "<p>Surname</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------role",
            "description": "<p>classification(I: Individual /R:Organization)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------organization",
            "description": "<p>Organization name</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------division",
            "description": "<p>division name</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------cc",
            "description": "<p>Country code (2digit ISO3166)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------pc",
            "description": "<p>Post code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------sp",
            "description": "<p>State or Prefecture (2digit JISX040)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------city",
            "description": "<p>City</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------street1",
            "description": "<p>Street1</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------street2",
            "description": "<p>Street2</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------phone",
            "description": "<p>Phone</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------fax",
            "description": "<p>Fax</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------email",
            "description": "<p>Email Adress</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------[contactMlBean]",
            "description": "<p>contact information in Japan</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "------------------lnameML",
            "description": "<p>First Name(in Japanese)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "------------------fnameML",
            "description": "<p>Surname(in Japanese)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "------------------organizationML",
            "description": "<p>Organization name(in Japanese)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "------------------divisionMLDivision",
            "description": "<p>name(in Japanese)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "------------------spML",
            "description": "<p>State (if in Japan JISX040 code)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "------------------cityML",
            "description": "<p>City(in japan)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "------------------street1ML",
            "description": "<p>street1( in Japanese)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "------------------street2ML",
            "description": "<p>street2( in Japanese)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "------------------registrationDate",
            "description": "<p>Registration Date(yyyy/MM/dd)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "------------------title",
            "description": "<p>title</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "------------------titleML",
            "description": "<p>title(in Japanese)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "------------------organizationMLKana",
            "description": "<p>Organization name in Japanese &quot;kana&quot;</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "------------------organizationType",
            "description": "<p>organization type(code)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "------------------registrationAddress",
            "description": "<p>Registration Address</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "------------------representName",
            "description": "<p>Representative Name(Surname Given name)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "------------------representNameML",
            "description": "<p>Representative Name(Surname Given name in Japanese)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "--------------[extension]",
            "description": "<p>extension information</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "-----------------entry",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "-------------------key:NEXUSCATEGORY",
            "description": "<p>value: Relationship with USA</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "-------------------key:NATIONALITY",
            "description": "<p>value: Nationality</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "-------------------key:APPPURPOSE",
            "description": "<p>value: Purpose</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "-------------------key:CEDCCLOCALITY",
            "description": "<p>value: CED code</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "-------------------key:CEDSTATE",
            "description": "<p>value: CED State or Prefecture</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "-------------------key:CEDCITY",
            "description": "<p>value: CED City</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "-------------------key:CEDFORM",
            "description": "<p>value: CED Certificate method</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "-------------------key:CEDIDENTIFICATIONNUMBER",
            "description": "<p>value: CED ID number</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "-------------------key:CEDLEGALENTITYTYPE",
            "description": "<p>value: CED Organization type</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "-------------------key:CEDREMARK1",
            "description": "<p>value: CED Organization name(others)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "-------------------key:CEDREMARK2",
            "description": "<p>value: CED Certificate method(others)</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"responseBean\": {\n  \"result\": {\n    \"actionType\": \"DomainInfo\",\n    \"resultCode\": \"10000\",\n    \"resultMsg\": \"Command completed successfully.\",\n    \"receiptNo\": \"20130617171806582507203E\",\n    \"terminate\": \"no\"\n  },\n  \"body\": {\n    \"list\": [\n      {\n        \"key\": \"domainid\",\n        \"value\": \"1234567\"\n      },\n      {\n        \"key\": \"domainname\",\n        \"value\": \"sample.com\"\n      },\n      {\n        \"key\": \"domainnameml\",\n        \"value\": \"sample.com\"\n      },\n      {\n        \"key\": \"expirationdate\",\n        \"value\": \"2014/06/17 08:12:10\"\n      },\n      {\n        \"key\": \"renewaldeadline\",\n        \"value\": \"2014/06/17\"\n      },\n      {\n        \"key\": \"createddate\",\n        \"value\": \"2013/06/17 08:12:10\"\n      },\n      {\n        \"key\": \"lastupdatedate\"\n      },\n      {\n        \"key\": \"autorenew\",\n        \"value\": \"no\"\n      },\n      {\n        \"key\": \"whoisproxy\",\n        \"value\": \"no\"\n      },\n      {\n        \"key\": \"status\",\n        \"value\": \"ACTIVE\"\n      },\n      {\n        \"key\": \"authcode\",\n        \"value\": \"gCrEwwfcAO1!\"\n      },\n      {\n        \"key\": \"ns\",\n        \"list\": [\n          \"dns1.interq.or.jp\",\n          \"dns2.interq.or.jp\"\n        ]\n      },\n      {\n        \"key\": \"contact\",\n        \"list\": [\n          {\n            \"type\": \"registrant\",\n            \"id\": \"64713203\",\n            \"status\": \"ACTIVE\",\n            \"lname\": \"Onamae\",\n            \"fname\": \"Reg-Taro\",\n            \"role\": \"I\",\n            \"organization\": \"REG ORGANIZATION\",\n            \"cc\": \"JP\",\n            \"pc\": \"150-0001\",\n            \"sp\": \"Tokyo\",\n            \"city\": \"Shibuya-ku\",\n            \"street1\": \"Sakuragaoka-cho\",\n            \"street2\": \"Cerulean Tower\",\n            \"phone\": \"03-1111-1111\",\n            \"fax\": \"03-2222-2222\",\n            \"email\": \"onamae-taro@gmo.jp\"\n          },\n          {\n            \"type\": \"admin\",\n            \"id\": \"64713202\",\n            \"status\": \"ACTIVE\",\n            \"lname\": \"Onamae\",\n            \"fname\": \"Adm-Taro\",\n            \"role\": \"I\",\n            \"organization\": \"ADM ORGANIZATION\",\n            \"cc\": \"JP\",\n            \"pc\": \"150-0001\",\n            \"sp\": \"Tokyo\",\n            \"city\": \"Shibuya-ku\",\n            \"street1\": \"Sakuragaoka-cho\",\n            \"street2\": \"Cerulean Tower\",\n            \"phone\": \"03-1111-1111\",\n            \"fax\": \"03-2222-2222\",\n            \"email\": \"onamae-taro@gmo.jp\"\n          },\n          {\n            \"type\": \"tech\",\n            \"id\": \"64713205\",\n            \"status\": \"ACTIVE\",\n            \"lname\": \"Onamae\",\n            \"fname\": \"Tec-Taro\",\n            \"role\": \"I\",\n            \"organization\": \"TEC ORGANIZATION\",\n            \"cc\": \"JP\",\n            \"pc\": \"150-0001\",\n            \"sp\": \"Tokyo\",\n            \"city\": \"Shibuya-ku\",\n            \"street1\": \"Sakuragaoka-cho\",\n            \"street2\": \"Cerulean Tower\",\n            \"phone\": \"03-1111-1111\",\n            \"fax\": \"03-2222-2222\",\n            \"email\": \"onamae-taro@gmo.jp\"\n          },\n          {\n            \"type\": \"billing\",\n            \"id\": \"64713204\",\n            \"status\": \"ACTIVE\",\n            \"lname\": \"Onamae\",\n            \"fname\": \"Bil-Taro\",\n            \"role\": \"I\",\n            \"organization\": \"BIL ORGANIZATION\",\n            \"cc\": \"JP\",\n            \"pc\": \"150-0001\",\n            \"sp\": \"Tokyo\",\n            \"city\": \"Shibuya-ku\",\n            \"street1\": \"Sakuragaoka-cho\",\n            \"street2\": \"Cerulean Tower\",\n            \"phone\": \"03-1111-1111\",\n            \"fax\": \"03-2222-2222\",\n            \"email\": \"onamae-taro@gmo.jp\"\n          }\n        ]\n      }\n    ]\n  }\n}}",
          "type": "json"
        }
      ]
    },
    "filename": "myapp/onamae.js",
    "groupTitle": "Domain"
  },
  {
    "type": "post",
    "url": "/onamai/domains/DomainRenew",
    "title": "Domain Renew",
    "version": "0.0.1",
    "name": "DomainRenew",
    "group": "Domain",
    "parameter": {
      "fields": {
        "Common parameter": [
          {
            "group": "Common parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token.</p>"
          },
          {
            "group": "Common parameter",
            "type": "String",
            "size": "18",
            "optional": false,
            "field": "domainId",
            "description": "<p>Domain Name.</p>"
          },
          {
            "group": "Common parameter",
            "type": "String[100]",
            "size": "18",
            "optional": false,
            "field": "domainIds",
            "description": "<p>multi domains Domain Name.</p>"
          },
          {
            "group": "Common parameter",
            "type": "String",
            "size": "255",
            "optional": false,
            "field": "domainName",
            "description": "<p>Domain Name.</p>"
          },
          {
            "group": "Common parameter",
            "type": "String[100]",
            "size": "255",
            "optional": false,
            "field": "domainNames",
            "description": "<p>multi domains Domain Name.</p>"
          },
          {
            "group": "Common parameter",
            "type": "String",
            "size": "10",
            "optional": false,
            "field": "curExpDate",
            "description": "<p>Current expiration date ('yyyy/MM/dd').</p>"
          },
          {
            "group": "Common parameter",
            "type": "String[100]",
            "size": "10",
            "optional": false,
            "field": "curExpDates",
            "description": "<p>multi domains current expiration date ('yyyy/MM/dd').</p>"
          },
          {
            "group": "Common parameter",
            "type": "String",
            "size": "2",
            "optional": false,
            "field": "period",
            "description": "<p>Renewal period.</p>"
          },
          {
            "group": "Common parameter",
            "type": "String[100]",
            "size": "2",
            "optional": false,
            "field": "periods",
            "description": "<p>multi domains renewal period.</p>"
          },
          {
            "group": "Common parameter",
            "type": "String",
            "size": "3",
            "allowedValues": [
              "\"yes\"",
              "\"no\""
            ],
            "optional": false,
            "field": "autoRenew",
            "description": "<p>auto renewal.</p>"
          },
          {
            "group": "Common parameter",
            "type": "String[100]",
            "size": "3",
            "allowedValues": [
              "\"yes\"",
              "\"no\""
            ],
            "optional": false,
            "field": "autoRenews",
            "description": "<p>multi domains auto renewal.</p>"
          },
          {
            "group": "Common parameter",
            "type": "String",
            "size": "3",
            "allowedValues": [
              "\"yes\"",
              "\"no\""
            ],
            "optional": false,
            "field": "RegistryPremium",
            "description": "<p>Registry Premium.</p>"
          },
          {
            "group": "Common parameter",
            "type": "String",
            "size": "20",
            "optional": false,
            "field": "clientTrid",
            "description": "<p>(option) Client transaction number.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "$url = 'https://services.shopup.com/onamai/domains/DomainRenew';\n$ch = curl_init();\ncurl_setopt($ch, CURLOPT_URL, $url);\ncurl_setopt($ch, CURLOPT_RETURNTRANSFER, true);\ncurl_setopt($ch, CURLOPT_POST, true);\n$post_array = array(\n 'token'=>$token,\n 'domainName'=>'Domainname',\n 'curExpDate'=>'2018/06/26', // วันที่โดเมนหมดอายุ ('yyyy/MM/dd')\n 'period'=>'1',\n 'autoRenew'=>'yes/no', \n 'RegistryPremium'=>'yes/no',\n);\n$post_array = http_build_query($post_array);\ncurl_setopt($ch, CURLOPT_POSTFIELDS, $post_array);\n$output = curl_exec($ch);",
        "type": "curl"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "responseBean",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "result",
            "description": "<p>Rabel for command result.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "actionType",
            "description": "<p>Command type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "resultCode",
            "description": "<p>Processing result code.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "resultMsg",
            "description": "<p>Processing result message.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "receiptNo",
            "description": "<p>Regist No.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "body",
            "description": "<p>A rabel for identifying domain information.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "key",
            "description": "<p>Domain name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "value",
            "description": "<p>Result (Registered:0/Available:1/Disapproval:2/Timeout:3/Email notification:5/Backorder:6/Auction:7).</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"responseBean\": {\n  \"id\": \"376563\",\n  \"result\": {\n    \"actionType\": \"DomainRenew\",\n    \"resultCode\": \"10000\",\n    \"resultMsg\": \"Command completed successfully.\",\n    \"receiptNo\": \"20130617180319531699203E\",\n    \"terminate\": \"no\"\n  },\n  \"details\": {\n    \"list\": [\n      {\n        \"id\": \"1991634\",\n        \"result\": {\n          \"actionType\": \"DomainRenew\",\n          \"resultCode\": \"10000\",\n          \"resultMsg\": \"Command completed successfully.\",\n          \"receiptNo\": \"20130617180319531699203E-OB00\",\n          \"object\": {\n            \"key\": \"domainName\",\n            \"value\": \"sample.com\"\n          },\n          \"terminate\": \"no\"\n        },\n        \"subResult\": {\n          \"list\": [\n            {\n              \"actionType\": \"DomainRenew\",\n              \"resultCode\": \"1000\",\n              \"resultMsg\": \"Command completed successfully\",\n              \"receiptNo\": \"20130617180319531699203E-OB00\",\n              \"main\": true\n            }\n          ]\n        },\n        \"body\": {\n          \"list\": [\n            {\n              \"key\": \"domainid\",\n              \"value\": \"5216235\"\n            },\n            {\n              \"key\": \"domainname\",\n              \"value\": \"sample.com\"\n            },\n            {\n              \"key\": \"expirationdate\",\n              \"value\": \"2019/06/17 08:12:10\"\n            }\n          ]\n        }\n      }\n    ]\n  }\n}}",
          "type": "json"
        }
      ]
    },
    "filename": "myapp/onamae.js",
    "groupTitle": "Domain"
  },
  {
    "type": "post",
    "url": "/onamai/domains/DomainUpdate",
    "title": "Domain Update",
    "version": "0.0.1",
    "name": "DomainUpdate",
    "group": "Domain",
    "parameter": {
      "fields": {
        "Common parameter": [
          {
            "group": "Common parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token.</p>"
          },
          {
            "group": "Common parameter",
            "type": "String",
            "size": "18",
            "optional": false,
            "field": "domainId",
            "description": "<p>Domain Name.</p>"
          },
          {
            "group": "Common parameter",
            "type": "String[100]",
            "size": "18",
            "optional": false,
            "field": "domainIds",
            "description": "<p>multi domains Domain Name.</p>"
          },
          {
            "group": "Common parameter",
            "type": "String",
            "size": "255",
            "optional": false,
            "field": "domainName",
            "description": "<p>Domain Name.</p>"
          },
          {
            "group": "Common parameter",
            "type": "String[100]",
            "size": "255",
            "optional": false,
            "field": "domainNames",
            "description": "<p>multi domains Domain Name.</p>"
          }
        ],
        "Domain Information": [
          {
            "group": "Domain Information",
            "type": "Array[13]",
            "size": "255",
            "optional": false,
            "field": "ns",
            "description": "<p>ข้อมูล Name server.</p>"
          },
          {
            "group": "Domain Information",
            "type": "Array[500]",
            "size": "3",
            "allowedValues": [
              "\"yes\"",
              "\"no\""
            ],
            "optional": false,
            "field": "autoRenew",
            "description": "<p>ต่ออายุอัตโนมัติ.</p>"
          },
          {
            "group": "Domain Information",
            "type": "Array[500]",
            "size": "3",
            "allowedValues": [
              "\"yes\"",
              "\"no\""
            ],
            "optional": false,
            "field": "transferLock",
            "description": "<p>Transfer lock(yes/no).</p>"
          },
          {
            "group": "Domain Information",
            "type": "Array[500]",
            "size": "3",
            "allowedValues": [
              "\"yes\"",
              "\"no\""
            ],
            "optional": false,
            "field": "nsExclusion",
            "description": "<p>Expired Nameserver(yes/no).</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "$url = 'https://services.shopup.com/onamai/domains/DomainUpdate';\n$ch = curl_init();\ncurl_setopt($ch, CURLOPT_URL, $url);\ncurl_setopt($ch, CURLOPT_RETURNTRANSFER, true);\ncurl_setopt($ch, CURLOPT_POST, true);\n$post_array = array(\n 'token'=>$token,\n 'domainName'=>'Domainname',\n 'curExpDate'=>'2018/06/26', // วันที่โดเมนหมดอายุ ('yyyy/MM/dd')\n 'period'=>'1',\n 'autoRenew'=>'yes/no', \n 'RegistryPremium'=>'yes/no',\n);\n$post_array = http_build_query($post_array);\ncurl_setopt($ch, CURLOPT_POSTFIELDS, $post_array);\n$output = curl_exec($ch);",
        "type": "curl"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "responseBean",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "result",
            "description": "<p>Rabel for command result.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "actionType",
            "description": "<p>Command type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "resultCode",
            "description": "<p>Processing result code.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "resultMsg",
            "description": "<p>Processing result message.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "receiptNo",
            "description": "<p>Regist No.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "body",
            "description": "<p>A rabel for identifying domain information.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "key",
            "description": "<p>Domain name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "value",
            "description": "<p>Result (Registered:0/Available:1/Disapproval:2/Timeout:3/Email notification:5/Backorder:6/Auction:7).</p>"
          }
        ]
      }
    },
    "filename": "myapp/onamae.js",
    "groupTitle": "Domain"
  },
  {
    "type": "post",
    "url": "/onamai/domains/ExchangeToken",
    "title": "Exchange token",
    "version": "0.0.1",
    "name": "ExchangeToken",
    "group": "Token",
    "examples": [
      {
        "title": "Example usage:",
        "content": "$url = 'https://services.shopup.com/onamai/domains/ExchangeToken';\n$ch = curl_init();\ncurl_setopt($ch,CURLOPT_URL,$url);\ncurl_setopt($ch,CURLOPT_RETURNTRANSFER,true);\ncurl_setopt($ch,CURLOPT_POST,true);\n$post_array = array(\n 'token'=>'Token',\n 'ip_address'=>'IpAddress'\n);\n$post_array = http_build_query($post_array);\ncurl_setopt($ch,CURLOPT_POSTFIELDS,$post_array);\n$output = curl_exec($ch);",
        "type": "curl"
      }
    ],
    "parameter": {
      "fields": {
        "Common parameter": [
          {
            "group": "Common parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token.</p>"
          },
          {
            "group": "Common parameter",
            "type": "String",
            "optional": false,
            "field": "ip_address",
            "description": "<p>IpAddress.</p>"
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
            "field": "result",
            "description": "<p>Result Type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "expire_token",
            "description": "<p>Token expire date.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token data.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"result\":\"ok\",\"data\":{\"expire_token\":\"2017-07-14\",\"token\":\"63fc7cab2624d6c56cf8c84e9dc208d2384a13aafdb05ea5a44678e4c88fd2f0\"}}",
          "type": "json"
        }
      ]
    },
    "filename": "myapp/onamae.js",
    "groupTitle": "Token"
  },
  {
    "type": "post",
    "url": "/onamai/domains/GetToken",
    "title": "Get token",
    "version": "0.0.1",
    "name": "GetToken",
    "group": "Token",
    "examples": [
      {
        "title": "Example usage:",
        "content": "$url = 'https://services.shopup.com/onamai/domains/GetToken';\n$ch = curl_init();\ncurl_setopt($ch,CURLOPT_URL,$url);\ncurl_setopt($ch,CURLOPT_RETURNTRANSFER,true);\ncurl_setopt($ch,CURLOPT_POST,true);\n$post_array = array(\n 'username'=>'Username',\n 'password'=>'Password',\n 'ip_address'=>'IpAddress'\n);\n$post_array = http_build_query($post_array);\ncurl_setopt($ch,CURLOPT_POSTFIELDS,$post_array);\n$output = curl_exec($ch);",
        "type": "curl"
      }
    ],
    "parameter": {
      "fields": {
        "Common parameter": [
          {
            "group": "Common parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>Username.</p>"
          },
          {
            "group": "Common parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Password.</p>"
          },
          {
            "group": "Common parameter",
            "type": "String",
            "optional": false,
            "field": "ip_address",
            "description": "<p>IpAddress.</p>"
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
            "field": "result",
            "description": "<p>Result Type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token data.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\"result\":\"ok\",\"data\":{\"token\":\"189c23445e1e52f66327c25faea46df7e991fcf87b3687bce5624c9fbf93046a\"}}",
          "type": "json"
        }
      ]
    },
    "filename": "myapp/onamae.js",
    "groupTitle": "Token"
  }
] });
