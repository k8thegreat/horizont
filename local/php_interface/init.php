<?

require_once "include/user_type_element_by_section.php";
define("CATALOG_IBLOCK_ID", 1);
define("DEVELOPER_IBLOCK_ID", 2);
define("BANKS_IBLOCK_ID", 4);
define("TRADE_IBLOCK_ID", 18);
define("METRO_IBLOCK_ID", 21);
define("FILTER_IBLOCK_ID", 24);

//error_reporting(E_ALL);
define("TRANSPORT_ICON",'<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 45.437 45.437" xml:space="preserve" width="14px" height="14px" fill="#d4d4d5"><g><path d="M41.403,11.11c-0.371-3.627-0.962-6.451-1.897-7.561c-3.855-4.564-30.859-4.898-33.925,0   c-0.75,1.2-1.276,4.014-1.629,7.567c-1.139,0.134-2.026,1.093-2.026,2.267v4.443c0,0.988,0.626,1.821,1.5,2.146   c-0.207,6.998-0.039,14.299,0.271,17.93c0,2.803,1.883,2.338,1.883,2.338h1.765v3.026c0,1.2,1.237,2.171,2.761,2.171   c1.526,0,2.763-0.971,2.763-2.171V40.24h20.534v3.026c0,1.2,1.236,2.171,2.762,2.171c1.524,0,2.761-0.971,2.761-2.171V40.24h0.58   c0,0,2.216,0.304,2.358-1.016c0-3.621,0.228-11.646,0.04-19.221c0.929-0.291,1.607-1.147,1.607-2.177v-4.443   C43.512,12.181,42.582,11.206,41.403,11.11z M12.176,4.2h20.735v3.137H12.176V4.2z M12.472,36.667c-1.628,0-2.947-1.32-2.947-2.948   c0-1.627,1.319-2.946,2.947-2.946s2.948,1.319,2.948,2.946C15.42,35.347,14.101,36.667,12.472,36.667z M32.8,36.667   c-1.627,0-2.949-1.32-2.949-2.948c0-1.627,1.321-2.946,2.949-2.946s2.947,1.319,2.947,2.946   C35.748,35.347,34.428,36.667,32.8,36.667z M36.547,23.767H8.54V9.077h28.007V23.767z"/></g></svg>');
define("FOOT_ICON", '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 93.646 93.646" fill="#d4d4d5" xml:space="preserve" width="14px" height="14px"><g><path d="M67.971,49.778l-9.378-10.345c-0.584-0.644-1.121-1.971-1.148-2.841L57.1,25.858v-0.311c0-1.654-1.346-3-3-3h-9.18h-3.648   c-1.478,0-3.127,1.047-3.756,2.384l-12.358,26.25c-0.342,0.728-0.376,1.541-0.096,2.292c0.28,0.75,0.84,1.342,1.575,1.666   l1.821,0.803c0.388,0.171,0.802,0.258,1.231,0.258h0c1.177,0,2.273-0.669,2.794-1.704l5.789-11.517v11.576   c-0.024,0.067-0.059,0.128-0.081,0.196l-9.783,30.638c-0.407,1.276-0.283,2.619,0.35,3.781s1.693,1.994,2.987,2.343l0.654,0.177   c0.428,0.116,0.872,0.175,1.318,0.175c2.251,0,4.296-1.481,4.974-3.603l9.141-28.628l3.242,7.941   c0.791,1.937,1.645,5.329,1.865,7.409l1.551,14.621c0.249,2.341,2.1,4.04,4.402,4.04c0.377,0,0.76-0.046,1.137-0.137l0.659-0.16   c2.624-0.635,4.478-3.331,4.133-6.008l-2.297-17.828c-0.292-2.265-1.269-5.812-2.178-7.907l-3.102-7.144   c-0.04-0.093-0.097-0.177-0.143-0.267v-4.841l5.59,5.836c0.556,0.581,1.3,0.901,2.094,0.901c0.803,0,1.553-0.326,2.111-0.918   l1.034-1.098C69.036,52.899,69.055,50.973,67.971,49.778z"/><path d="M48.52,20.005c5.516,0,10.003-4.487,10.003-10.003C58.523,4.487,54.036,0,48.52,0c-5.515,0-10.001,4.487-10.001,10.002   C38.518,15.518,43.005,20.005,48.52,20.005z"/></g></svg>');
define("LIST_VIEW_ICON", '<svg version="1.1" class="svg-result-sort" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 16 16"><path d="M0 1h3v2h-3v-2z"></path><path d="M0 5h3v2h-3v-2z"></path><path d="M0 9h3v2h-3v-2z"></path><path d="M0 13h3v2h-3v-2z"></path><path d="M4 1h12v2h-12v-2z"></path><path d="M4 5h12v2h-12v-2z"></path><path d="M4 9h12v2h-12v-2z"></path><path d="M4 13h12v2h-12v-2z"></path></svg>');
define("BLOCK_VIEW_ICON", '<svg version="1.1" class="svg-result-sort" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16" height="16" viewBox="0 0 278 278" style="enable-background:new 0 0 278 278;" xml:space="preserve"><g><rect x="0" y="0" width="119.054" height="119.054"/><rect x="158.946" y="0" width="119.054" height="119.054"/><rect x="158.946" y="158.946" width="119.054" height="119.054"/><rect x="0" y="158.946" width="119.054" height="119.054"/></g></svg>');
define("MAP_VIEW_ICON", '<svg version="1.1" class="svg-result-sort" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16" height="16" viewBox="0 0 54.757 54.757" style="enable-background:new 0 0 54.757 54.757;" xml:space="preserve"><path d="M40.94,5.617C37.318,1.995,32.502,0,27.38,0c-5.123,0-9.938,1.995-13.56,5.617c-6.703,6.702-7.536,19.312-1.804,26.952 L27.38,54.757L42.721,32.6C48.476,24.929,47.643,12.319,40.94,5.617z M27.557,26c-3.859,0-7-3.141-7-7s3.141-7,7-7s7,3.141,7,7 S31.416,26,27.557,26z"/></svg>');
define("FILTER_ICON",'<svg class="svg-result-sort" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 612.006 612.006" xml:space="preserve"><path d="M292.911,318.872H14.833C6.639,318.872,0,312.232,0,304.04c0-8.194,6.639-14.833,14.833-14.833h278.078 c8.194,0,14.833,6.639,14.833,14.833C307.744,312.232,301.105,318.872,292.911,318.872z"/><path d="M597.167,318.872H449.638c-8.193,0-14.833-6.64-14.833-14.833c0-8.194,6.64-14.833,14.833-14.833h147.529 c8.193,0,14.833,6.639,14.833,14.833C612,312.232,605.36,318.872,597.167,318.872z"/><path d="M214.545,506.712H14.833C6.639,506.712,0,500.072,0,491.88c0-8.193,6.639-14.834,14.833-14.834h199.712 c8.194,0,14.833,6.641,14.833,14.834C229.378,500.072,222.739,506.712,214.545,506.712z"/><path d="M597.167,506.712H371.266c-8.193,0-14.833-6.64-14.833-14.833c0-8.192,6.64-14.833,14.833-14.833h225.901 c8.193,0,14.833,6.641,14.833,14.833C612,500.072,605.36,506.712,597.167,506.712z"/><path d="M129.368,134.96H14.833C6.639,134.96,0,128.32,0,120.127s6.639-14.833,14.833-14.833h114.535 c8.193,0,14.833,6.639,14.833,14.833S137.562,134.96,129.368,134.96z"/><path d="M597.167,134.96H286.1c-8.194,0-14.833-6.639-14.833-14.833s6.639-14.833,14.833-14.833h311.073 c8.193,0,14.833,6.639,14.833,14.833C612,128.32,605.36,134.96,597.167,134.96z"/><path d="M175.635,181.215c-33.695,0-61.101-27.406-61.101-61.1c0-33.683,27.406-61.089,61.101-61.089 c33.683,0,61.088,27.406,61.088,61.089C236.718,153.81,209.312,181.215,175.635,181.215z M175.635,88.693 c-17.331,0-31.434,14.097-31.434,31.422c0,17.331,14.103,31.434,31.434,31.434c17.325,0,31.422-14.104,31.422-31.434 C207.052,102.791,192.954,88.693,175.635,88.693z"/><path d="M257.709,552.979c-33.695,0-61.1-27.406-61.1-61.102c0-33.688,27.405-61.095,61.1-61.095 c33.689,0,61.094,27.406,61.094,61.095C318.798,525.573,291.393,552.979,257.709,552.979z M257.709,460.45 c-17.331,0-31.434,14.099-31.434,31.43c0,17.33,14.103,31.435,31.434,31.435s31.428-14.104,31.428-31.435 C289.137,474.549,275.035,460.45,257.709,460.45z"/><path d="M339.173,365.121c-33.689,0-61.095-27.404-61.095-61.094c0-33.683,27.406-61.089,61.095-61.089 c33.688,0,61.094,27.406,61.094,61.089C400.267,337.716,372.861,365.121,339.173,365.121z M339.173,272.605 c-17.331,0-31.429,14.097-31.429,31.422c0,17.331,14.098,31.428,31.429,31.428s31.428-14.097,31.428-31.428 C370.601,286.702,356.504,272.605,339.173,272.605z"/></svg>');
define("TIME_ICON", '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="14px" height="14px" viewBox="0 0 97.16 97.16" fill="#d4d4d5" xml:space="preserve"><g><path d="M48.58,0C21.793,0,0,21.793,0,48.58s21.793,48.58,48.58,48.58s48.58-21.793,48.58-48.58S75.367,0,48.58,0z M48.58,86.823 c-21.087,0-38.244-17.155-38.244-38.243S27.493,10.337,48.58,10.337S86.824,27.492,86.824,48.58S69.667,86.823,48.58,86.823z"/><path d="M73.898,47.08H52.066V20.83c0-2.209-1.791-4-4-4c-2.209,0-4,1.791-4,4v30.25c0,2.209,1.791,4,4,4h25.832 c2.209,0,4-1.791,4-4S76.107,47.08,73.898,47.08z"/></g></svg>');
define("PDF_ICON", '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 533.333 533.333" xml:space="preserve"><g><path d="M438.548,307.021c-7.108-7.003-22.872-10.712-46.86-11.027c-16.238-0.179-35.782,1.251-56.339,4.129 c-9.205-5.311-18.691-11.091-26.139-18.051c-20.033-18.707-36.755-44.673-47.175-73.226c0.679-2.667,1.257-5.011,1.795-7.403 c0,0,11.284-64.093,8.297-85.763c-0.411-2.972-0.664-3.834-1.463-6.144l-0.98-2.518c-3.069-7.079-9.087-14.58-18.522-14.171 l-5.533-0.176l-0.152-0.003c-10.521,0-19.096,5.381-21.347,13.424c-6.842,25.226,0.218,62.964,13.012,111.842l-3.275,7.961 c-9.161,22.332-20.641,44.823-30.77,64.665l-1.317,2.581c-10.656,20.854-20.325,38.557-29.09,53.554l-9.05,4.785 c-0.659,0.348-16.169,8.551-19.807,10.752c-30.862,18.427-51.313,39.346-54.706,55.946c-1.08,5.297-0.276,12.075,5.215,15.214 l8.753,4.405c3.797,1.902,7.801,2.866,11.903,2.866c21.981,0,47.5-27.382,82.654-88.732 c40.588-13.214,86.799-24.197,127.299-30.255c30.864,17.379,68.824,29.449,92.783,29.449c4.254,0,7.921-0.406,10.901-1.194 c4.595-1.217,8.468-3.838,10.829-7.394c4.648-6.995,5.591-16.631,4.329-26.497C443.417,313.113,441.078,309.493,438.548,307.021z M110.233,423.983c4.008-10.96,19.875-32.627,43.335-51.852c1.475-1.196,5.108-4.601,8.435-7.762 C137.47,403.497,121.041,419.092,110.233,423.983z M249.185,104.003c7.066,0,11.085,17.81,11.419,34.507 c0.333,16.698-3.572,28.417-8.416,37.088c-4.012-12.838-5.951-33.073-5.951-46.304 C246.237,129.294,245.942,104.003,249.185,104.003z M207.735,332.028c4.922-8.811,10.043-18.103,15.276-27.957 c12.756-24.123,20.812-42.999,26.812-58.514c11.933,21.71,26.794,40.167,44.264,54.955c2.179,1.844,4.488,3.698,6.913,5.547 C265.474,313.088,234.769,321.637,207.735,332.028z M431.722,330.027c-2.164,1.353-8.362,2.135-12.349,2.135 c-12.867,0-28.787-5.883-51.105-15.451c8.575-0.635,16.438-0.957,23.489-0.957c12.906,0,16.729-0.056,29.349,3.163 S433.885,328.674,431.722,330.027z M470.538,103.87L396.13,29.463C379.925,13.258,347.917,0,325,0H75 C52.083,0,33.333,18.75,33.333,41.667v450c0,22.916,18.75,41.666,41.667,41.666h383.333c22.916,0,41.666-18.75,41.666-41.666V175 C500,152.083,486.742,120.074,470.538,103.87z M446.968,127.44c1.631,1.631,3.255,3.633,4.833,5.893h-85.134V48.2 c2.261,1.578,4.263,3.203,5.893,4.833L446.968,127.44z M466.667,491.667c0,4.517-3.816,8.333-8.333,8.333H75 c-4.517,0-8.333-3.816-8.333-8.333v-450c0-4.517,3.817-8.333,8.333-8.333h250c2.517,0,5.341,0.318,8.334,0.887v132.446H465.78 c0.569,2.993,0.887,5.816,0.887,8.333V491.667z"/></g></svg>');
define("PRINT_ICON", '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 508 508" xml:space="preserve"> <g> <g> <path d="M438.85,94.4h-36.8V14.1c0-7.8-6.3-14.1-14.1-14.1h-267.8c-7.8,0-14.1,6.3-14.1,14.1v80.2h-36.9 c-38.1,0.1-69.1,31.1-69.1,69.3v139.3c0,38.1,31,69.1,69.1,69.1h36.9v121.9c0,7.8,6.3,14.1,14.1,14.1h267.7 c7.8,0,14.1-6.3,14.1-14.1V372h36.8c38.2,0,69.2-31,69.2-69.1V163.6C508.05,125.4,477.05,94.4,438.85,94.4z M134.25,28.2h239.5 v66.1h-239.5V28.2z M373.75,479.8h-239.5V323.6h239.5V479.8z M438.85,343.7h-36.8v-20.1h17.3c7.8,0,14.1-6.3,14.1-14.1 c0-7.8-6.3-14.1-14.1-14.1H88.75c-7.8,0-14.1,6.3-14.1,14.1s6.3,14.1,14.1,14.1h17.3v20.1h-36.9c-22.6,0-40.9-18.4-40.9-40.9 V163.6c0-22.6,18.4-41,40.9-41h369.6c22.6,0,41,18.4,41,41v139.2h0.1C479.85,325.4,461.45,343.7,438.85,343.7z"/> </g> </g> <g> <g> <path d="M331.45,420.6h-154.8c-7.8,0-14.1,6.3-14.1,14.1c0,7.7,6.3,14.1,14.1,14.1h154.8c7.8,0,14.1-6.3,14.1-14.1 C345.55,426.9,339.25,420.6,331.45,420.6z"/> </g> </g> <g> <g> <path d="M331.45,359.5h-154.8c-7.8,0-14.1,6.3-14.1,14.1s6.3,14.1,14.1,14.1h154.8c7.8,0,14.1-6.3,14.1-14.1 C345.55,365.8,339.25,359.5,331.45,359.5z"/> </g> </g><g><g><circle cx="433.45" cy="168.8" r="14.1"/></g></g><g><g><circle cx="433.45" cy="217.5" r="14.1"/></g></g></svg>');
define("SHARE_ICON", '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 481.6 481.6" xml:space="preserve"> <g> <path d="M381.6,309.4c-27.7,0-52.4,13.2-68.2,33.6l-132.3-73.9c3.1-8.9,4.8-18.5,4.8-28.4c0-10-1.7-19.5-4.9-28.5l132.2-73.8 c15.7,20.5,40.5,33.8,68.3,33.8c47.4,0,86.1-38.6,86.1-86.1S429,0,381.5,0s-86.1,38.6-86.1,86.1c0,10,1.7,19.6,4.9,28.5 l-132.1,73.8c-15.7-20.6-40.5-33.8-68.3-33.8c-47.4,0-86.1,38.6-86.1,86.1s38.7,86.1,86.2,86.1c27.8,0,52.6-13.3,68.4-33.9 l132.2,73.9c-3.2,9-5,18.7-5,28.7c0,47.4,38.6,86.1,86.1,86.1s86.1-38.6,86.1-86.1S429.1,309.4,381.6,309.4z M381.6,27.1 c32.6,0,59.1,26.5,59.1,59.1s-26.5,59.1-59.1,59.1s-59.1-26.5-59.1-59.1S349.1,27.1,381.6,27.1z M100,299.8 c-32.6,0-59.1-26.5-59.1-59.1s26.5-59.1,59.1-59.1s59.1,26.5,59.1,59.1S132.5,299.8,100,299.8z M381.6,454.5 c-32.6,0-59.1-26.5-59.1-59.1c0-32.6,26.5-59.1,59.1-59.1s59.1,26.5,59.1,59.1C440.7,428,414.2,454.5,381.6,454.5z"/> </g> </svg>');
define("ARROW_DOWN", '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" class="btn-drop-table-ico" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 49.656 49.656" xml:space="preserve"><g><polygon points="1.414,14.535 4.242,11.707 24.828,32.292 45.414,11.707 48.242,14.535 24.828,37.95"/><path d="M24.828,39.364L0,14.536l4.242-4.242l20.586,20.585l20.586-20.586l4.242,4.242L24.828,39.364zM2.828,14.536l22,22l22-22.001l-1.414-1.414L24.828,33.707L4.242,13.122L2.828,14.536z"/></g></svg>');
define("ADDRESS_ICON", '<svg xmlns="http://www.w3.org/2000/svg" class="address-ico" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 60 60" xml:space="preserve"><g><path d="M30,26c3.86,0,7-3.141,7-7s-3.14-7-7-7s-7,3.141-7,7S26.14,26,30,26z M30,14c2.757,0,5,2.243,5,5s-2.243,5-5,5   s-5-2.243-5-5S27.243,14,30,14z"/><path d="M29.823,54.757L45.164,32.6c5.754-7.671,4.922-20.28-1.781-26.982C39.761,1.995,34.945,0,29.823,0   s-9.938,1.995-13.56,5.617c-6.703,6.702-7.535,19.311-1.804,26.952L29.823,54.757z M17.677,7.031C20.922,3.787,25.235,2,29.823,2   s8.901,1.787,12.146,5.031c6.05,6.049,6.795,17.437,1.573,24.399L29.823,51.243L16.082,31.4   C10.882,24.468,11.628,13.08,17.677,7.031z"/><path d="M42.117,43.007c-0.55-0.067-1.046,0.327-1.11,0.876s0.328,1.046,0.876,1.11C52.399,46.231,58,49.567,58,51.5   c0,2.714-10.652,6.5-28,6.5S2,54.214,2,51.5c0-1.933,5.601-5.269,16.117-6.507c0.548-0.064,0.94-0.562,0.876-1.11   c-0.065-0.549-0.561-0.945-1.11-0.876C7.354,44.247,0,47.739,0,51.5C0,55.724,10.305,60,30,60s30-4.276,30-8.5   C60,47.739,52.646,44.247,42.117,43.007z" /></g></svg>');
define("PHONE_ICON", '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 60 60" xml:space="preserve"><g><path d="M42.595,0H17.405C14.977,0,13,1.977,13,4.405v51.189C13,58.023,14.977,60,17.405,60h25.189C45.023,60,47,58.023,47,55.595   V4.405C47,1.977,45.023,0,42.595,0z M15,8h30v38H15V8z M17.405,2h25.189C43.921,2,45,3.079,45,4.405V6H15V4.405   C15,3.079,16.079,2,17.405,2z M42.595,58H17.405C16.079,58,15,56.921,15,55.595V48h30v7.595C45,56.921,43.921,58,42.595,58z"/><path d="M30,49c-2.206,0-4,1.794-4,4s1.794,4,4,4s4-1.794,4-4S32.206,49,30,49z M30,55c-1.103,0-2-0.897-2-2s0.897-2,2-2   s2,0.897,2,2S31.103,55,30,55z"/><path d="M26,5h4c0.553,0,1-0.447,1-1s-0.447-1-1-1h-4c-0.553,0-1,0.447-1,1S25.447,5,26,5z"/><path d="M33,5h1c0.553,0,1-0.447,1-1s-0.447-1-1-1h-1c-0.553,0-1,0.447-1,1S32.447,5,33,5z"/><path d="M56.612,4.569c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414c3.736,3.736,3.736,9.815,0,13.552   c-0.391,0.391-0.391,1.023,0,1.414c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293   C61.128,16.434,61.128,9.085,56.612,4.569z"/><path d="M52.401,6.845c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414c1.237,1.237,1.918,2.885,1.918,4.639   s-0.681,3.401-1.918,4.638c-0.391,0.391-0.391,1.023,0,1.414c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293   c1.615-1.614,2.504-3.764,2.504-6.052S54.017,8.459,52.401,6.845z"/><path d="M4.802,5.983c0.391-0.391,0.391-1.023,0-1.414s-1.023-0.391-1.414,0c-4.516,4.516-4.516,11.864,0,16.38   c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293c0.391-0.391,0.391-1.023,0-1.414   C1.065,15.799,1.065,9.72,4.802,5.983z"/><path d="M9.013,6.569c-0.391-0.391-1.023-0.391-1.414,0c-1.615,1.614-2.504,3.764-2.504,6.052s0.889,4.438,2.504,6.053   c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293c0.391-0.391,0.391-1.023,0-1.414   c-1.237-1.237-1.918-2.885-1.918-4.639S7.775,9.22,9.013,7.983C9.403,7.593,9.403,6.96,9.013,6.569z"/></g></svg>');
define("EMAIL_ICON", '<svg xmlns="http://www.w3.org/2000/svg" class="e-mail" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 31.012 31.012" xml:space="preserve" ><g><g><path d="M25.109,21.51c-0.123,0-0.246-0.045-0.342-0.136l-5.754-5.398c-0.201-0.188-0.211-0.505-0.022-0.706    c0.189-0.203,0.504-0.212,0.707-0.022l5.754,5.398c0.201,0.188,0.211,0.505,0.022,0.706C25.375,21.457,25.243,21.51,25.109,21.51z"/><path d="M5.902,21.51c-0.133,0-0.266-0.053-0.365-0.158c-0.189-0.201-0.179-0.518,0.022-0.706l5.756-5.398    c0.202-0.188,0.519-0.18,0.707,0.022c0.189,0.201,0.179,0.518-0.022,0.706l-5.756,5.398C6.148,21.465,6.025,21.51,5.902,21.51z"/></g><path d="M28.512,26.529H2.5c-1.378,0-2.5-1.121-2.5-2.5V6.982c0-1.379,1.122-2.5,2.5-2.5h26.012c1.378,0,2.5,1.121,2.5,2.5v17.047   C31.012,25.408,29.89,26.529,28.512,26.529z M2.5,5.482c-0.827,0-1.5,0.673-1.5,1.5v17.047c0,0.827,0.673,1.5,1.5,1.5h26.012   c0.827,0,1.5-0.673,1.5-1.5V6.982c0-0.827-0.673-1.5-1.5-1.5H2.5z"/><path d="M15.506,18.018c-0.665,0-1.33-0.221-1.836-0.662L0.83,6.155C0.622,5.974,0.6,5.658,0.781,5.449   c0.183-0.208,0.498-0.227,0.706-0.048l12.84,11.2c0.639,0.557,1.719,0.557,2.357,0L29.508,5.419   c0.207-0.181,0.522-0.161,0.706,0.048c0.181,0.209,0.16,0.524-0.048,0.706L17.342,17.355   C16.835,17.797,16.171,18.018,15.506,18.018z"/></g></svg>');
define("SCHEDULE_ICON", '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 60 60" xml:space="preserve"><g><path d="M30,0C13.458,0,0,13.458,0,30s13.458,30,30,30s30-13.458,30-30S46.542,0,30,0z M30,58C14.561,58,2,45.439,2,30   S14.561,2,30,2s28,12.561,28,28S45.439,58,30,58z"/><path d="M30,6c-0.552,0-1,0.447-1,1v23H14c-0.552,0-1,0.447-1,1s0.448,1,1,1h16c0.552,0,1-0.447,1-1V7C31,6.447,30.552,6,30,6z"/></g></svg>');
define("DOWNLOAD_ICON", '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 471.2 471.2" xml:space="preserve"><g><g><path d="M457.7,230.15c-7.5,0-13.5,6-13.5,13.5v122.8c0,33.4-27.2,60.5-60.5,60.5H87.5c-33.4,0-60.5-27.2-60.5-60.5v-124.8    c0-7.5-6-13.5-13.5-13.5s-13.5,6-13.5,13.5v124.8c0,48.3,39.3,87.5,87.5,87.5h296.2c48.3,0,87.5-39.3,87.5-87.5v-122.8    C471.2,236.25,465.2,230.15,457.7,230.15z"/><path d="M226.1,346.75c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4l85.8-85.8c5.3-5.3,5.3-13.8,0-19.1c-5.3-5.3-13.8-5.3-19.1,0l-62.7,62.8    V30.75c0-7.5-6-13.5-13.5-13.5s-13.5,6-13.5,13.5v273.9l-62.8-62.8c-5.3-5.3-13.8-5.3-19.1,0c-5.3,5.3-5.3,13.8,0,19.1    L226.1,346.75z"/></g></g></svg>');
define("ARROW_LEFT", '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 451.847 451.847" xml:space="preserve"><g><path d="M225.923,354.706c-8.098,0-16.195-3.092-22.369-9.263L9.27,151.157c-12.359-12.359-12.359-32.397,0-44.751   c12.354-12.354,32.388-12.354,44.748,0l171.905,171.915l171.906-171.909c12.359-12.354,32.391-12.354,44.744,0   c12.365,12.354,12.365,32.392,0,44.751L248.292,345.449C242.115,351.621,234.018,354.706,225.923,354.706z"/></g></svg>');
define("MENU_ICON", '<svg class="menu-btn-ico" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 344.339 344.339" xml:space="preserve"><g><rect y="46.06" width="344.339" height="29.52"/></g><g><rect y="156.506" width="344.339" height="29.52"/></g><g><rect y="268.748" width="344.339" height="29.531"/></g></svg>');
define("PHONE_ICON", '<svg class="callback-ico" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><path d="M492.438,397.75l-2.375-7.156c-5.625-16.719-24.063-34.156-41-38.75l-62.688-17.125c-17-4.625-41.25,1.594-53.688,14.031 L310,371.438c-82.453-22.281-147.109-86.938-169.359-169.375l22.688-22.688c12.438-12.438,18.656-36.656,14.031-53.656L160.266,63 c-4.625-16.969-22.094-35.406-38.781-40.969l-7.156-2.406c-16.719-5.563-40.563,0.063-53,12.5L27.391,66.094 c-6.063,6.031-9.938,23.281-9.938,23.344C16.266,197.188,58.516,301,134.734,377.219c76.031,76.031,179.453,118.219,286.891,117.313 c0.563,0,18.313-3.813,24.375-9.844l33.938-33.938C492.375,438.313,498,414.469,492.438,397.75z"/></svg>');
define("ARROW_LEFT_BLUE", '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 451.847 451.847" xml:space="preserve"><g><path d="M225.923,354.706c-8.098,0-16.195-3.092-22.369-9.263L9.27,151.157c-12.359-12.359-12.359-32.397,0-44.751   c12.354-12.354,32.388-12.354,44.748,0l171.905,171.915l171.906-171.909c12.359-12.354,32.391-12.354,44.744,0   c12.365,12.354,12.365,32.392,0,44.751L248.292,345.449C242.115,351.621,234.018,354.706,225.923,354.706z"/></g></svg>');



if (CModule::IncludeModule("iblock")) {
    $res = CIBlockElement::GetList(Array("PROPERTY_RATE" => "ASC"), Array("IBLOCK_ID" => BANKS_IBLOCK_ID, "ACTIVE" => "Y", ">PROPERTY_RATE" => 0), false, array());
    if ($ob = $res->GetNextElement()) {
        $arProps = $ob->GetProperties();
        if($arProps["RATE"]["VALUE"])
            define("RATE_MIN_GLOBAL", $arProps["RATE"]["VALUE"]);
    }
    else
        define("RATE_MIN_GLOBAL", false);
}

global $arFIlterSections, $propFilterArr, $propFilterArrByID;

$arFIlterSections = array();
$rsSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => FILTER_IBLOCK_ID, "ACTIVE" => "Y"), false, array("ID", "NAME", "CODE", "XML_ID"));
while ($arSection = $rsSections->GetNext())
{
    $arFIlterSections[$arSection["CODE"]] = $arSection;
    $arFIlterSectionsByID[$arSection["ID"]] = $arSection;
}

$res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>FILTER_IBLOCK_ID, "ACTIVE"=>"Y"), false, Array(), Array("ID", "NAME", "XML_ID", "CODE", "IBLOCK_SECTION_ID"));
while($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arFields["SECTION"] = $arFIlterSectionsByID[$arFields["IBLOCK_SECTION_ID"]]["CODE"];
    $propFilterArr[$arFields["XML_ID"]] = $propFilterArrByID[$arFields["ID"]] = $arFields;

}


function addFilterValue($code, $value, $xml_id = null){
    global $arFIlterSections, $propFilterArr;
    if(CModule::IncludeModule("iblock")) {
        $elemCode = ($xml_id ? $code . "_" . $xml_id : $code . "_" .CUtil::Translit($value, "ru", array("replace_space" => "-", "replace_other" => "-")));
        $el = new CIBlockElement;
        $arFilterPropArray = Array(
            "IBLOCK_SECTION_ID" => $arFIlterSections[$code]["ID"],
            "IBLOCK_ID" => FILTER_IBLOCK_ID,
            "NAME" => $value,
            "ACTIVE" => "Y",
            "XML_ID" => $elemCode,
            "CODE" => $elemCode
        );
        if ($ID = $el->Add($arFilterPropArray)) {
            $arSelect = Array("ID", "NAME", "XML_ID");
            $arFilter = Array("IBLOCK_ID" => FILTER_IBLOCK_ID, "ACTIVE" => "Y", "ID" => $ID);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
            if ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $propFilterArr[$arFields["XML_ID"]] = $arFields;
            }
        }
        return $ID;
    }
}

function formatObjectString($num){
    if($num>10 && $num<15){
        $str = "объектов";
    }else {
        $s = ($num % 10);
        if($s==0 || ($s>4 && $s<10))
            $str = "объектов";
        elseif ($s==1)
            $str = "объект";
        elseif($s>1 && $s < 5)
            $str = "объекта";
    }
    return $str;
}

function formatApartment($num){
    if($num>10 && $num<15){
        $str = "квартир";
    }else {
        $s = ($num % 10);
        if($s==0 || ($s>4 && $s<10))
            $str = "квартир";
        elseif ($s==1)
            $str = "квартира";
        elseif($s>1 && $s < 5)
            $str = "квартиры";
    }
    return $str;
}

global $linesArr;

$linesArr = array(
    "green" => array(50, 8, 16, 34, 4, 21, 33, 51, 43, 54),
    "red" => array(17, 18, 3, 49, 38, 31, 14, 29, 64, 13, 10, 53, 60, 5, 39, 24, 1, 30, 9),
    "blue" => array(46, 52, 44, 61, 48, 63, 47, 15, 40, 56, 60, 62, 37, 66, 45, 36, 22, 27),
    "orange" => array(57, 19, 32, 4, 41, 28, 6, 20),
    "purple" => array(25, 59, 26, 65, 58, 55, 23, 42, 11, 7, 35)
);

function getMetroIcon($class){
    return '<svg version="1.1" class="'.$class.'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="14px" height="14px" viewBox="0 0 94.69 94.691" xml:space="preserve"><g><path d="M62.695,10.642l-15.35,48.393L31.996,10.642C13.737,16.918,0,33.943,0,53.461c0,11.756,4.796,22.597,12.555,30.587h22.254 l2.333-10.117C10.556,63.514,15.583,31.235,25.221,25.966C26.365,26.31,43.129,83.81,43.129,83.81c0.229,0,0.973,0,1.882,0 c0.192,0,0.915,0,1.816,0c0.326,0,0.678,0,1.035,0c0.612,0,1.247,0,1.815,0c0.91,0,1.653,0,1.883,0c0,0,16.765-57.5,17.908-57.844 c9.639,5.269,14.664,37.548-11.922,47.965l2.334,10.117h22.254c7.76-7.99,12.556-18.831,12.556-30.587 C94.69,33.943,80.953,16.918,62.695,10.642z"/></g></svg>';
}

function getColoredIcon($id){
    global $linesArr;
    $result="";
    foreach ($linesArr as $color => $arr){
        if(in_array($id, $arr))
            $result.= getMetroIcon("ico-".$color);
    }
    return $result;
}

function printMetroValue($val, $showicon = null){
    $string = "";
    if (CModule::IncludeModule("iblock")) {
        if(IntVal($val)){
            $arFilter = Array("IBLOCK_ID" => METRO_IBLOCK_ID, "ACTIVE" => "Y", "ID" => $val);
        }else{
            $arFilter = Array("IBLOCK_ID" => METRO_IBLOCK_ID, "ACTIVE" => "Y", "NAME" => "%".trim($val)."%");
        }
        $arSelect = Array("ID", "NAME", "XML_ID");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        if ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $item_xml_id = $arFields["XML_ID"];
            $item_name = $arFields["NAME"];
            if($showicon)
                $result = "<span>".getColoredIcon($item_xml_id)." ".$item_name."</span>";
            else
                $result = $item_name;
        }
        else
            $result = $val;
    }
    return $result;
}

function formatReadyDate($str, $checkCurrent = false){

    $numbers = array(1 => "I", 2 => "II", 3 => "III", 4 => "IV");
    $arr = explode(".", $str);
    $quarter = intval($arr[1]);
    $year = intval($arr[0]);
    if(true){
        $currQuarter = ceil(date("n")/3);
        $currYear = intval(date("Y"));
        if($year <= $currYear && $quarter< $currQuarter)
            $result = "сдан";
        else
            $result = $numbers[$quarter]." кв. ".$year;
    }
    return $result;
}
function formatPrice($price){
    return number_format($price, 0, ".", " ")." руб.";
}
function cmp($a, $b)
{
    $aArr = explode(" ", $a);
    $bArr = explode(" ", $b);
    if (($aArr[0] == $bArr[0]) && ($aArr[2] == $bArr[2])) {
        return 0;
    }
    return (($aArr[2] < $bArr[2]) || (($aArr[2] == $bArr[2]) && $aArr[0] < $bArr[0]))  ? -1 : 1;
}

function convertQuaterToDate($quater, $year){
    $quater = IntVal($quater);
    switch ($quater){
        case 1:
            $month = "01.02";
            break;
        case 2:
            $month = "01.05";
            break;
        case 3:
            $month = "01.08";
            break;
        case 4:
            $month = "01.11";
            break;
    }
    $date = $month.".".$year." 00:00:00";
    return $date;
}
global $arTransalteParams;



AddEventHandler("iblock", "OnBeforeIBlockElementAdd", "addCodeFunction");
AddEventHandler("iblock", "OnBeforeIBlockSectionAdd", "addCodeFunction");
//AddEventHandler("iblock", "OnAfterIBlockElementAdd", "updatePrice");
//AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "updatePrice");
AddEventHandler("iblock", "OnAfterIBlockSectionUpdate", "sectionUpdate");

function sectionUpdate(&$arFields){
    global $propFilterArr, $arFIlterSections;
    if($arFields["IBLOCK_ID"] == CATALOG_IBLOCK_ID  && $arFields["RESULT"]){
        $SECTION_ID = $arFields["ID"];
        $arSelect = Array("ID", "NAME", "XML_ID");
        $arFilter = Array("IBLOCK_ID"=>FILTER_IBLOCK_ID, "ACTIVE"=>"Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        while($ob = $res->GetNextElement()) {
            $arFields2 = $ob->GetFields();
            $propFilterArr[$arFields["XML_ID"]] = $arFields2;
        }
        //Convert properties for elements
        //ZHK NAME
        $value = $arFields["NAME"];
        $code = "zhk_".CUtil::Translit($value, "ru", array("replace_space" => "-", "replace_other" => "-"));
        if($propFilterArr[$code]) {
            $arrElementProps["filter"][] = $propFilterArr[$code]["ID"];
        }else{
            $ID = addFilterValue("zhk", $value);
            $arrElementProps["filter"][] = $ID;
        }
        //UF_METRO_ID
        $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>METRO_IBLOCK_ID, "ACTIVE"=>"Y"), false, Array("nPageSize"=>100), Array("ID", "NAME", "XML_ID"));
        while($ob = $res->GetNextElement()) {
            $arMetroFields = $ob->GetFields();
            $propMetroArr[$arMetroFields["ID"]] = $arMetroFields;
        }
        foreach ($arFields["UF_METRO_ID"] as $val){
            $val_xml_id = $propMetroArr[$val]["XML_ID"];
            $arrElementProps["filter"][] = $propFilterArr["metro_id_".$val_xml_id]["ID"];
            $arrElementProps["metro_id"][] = $val;
        }
        //UF_PAYEMNT
        $ob = CUserFieldEnum::GetList( array(), array('USER_FIELD_ID'=> 14));
        while( $res = $ob->Fetch())
        {
            $paymentSectionArrByID[$res["ID"]] = $res;
        }
        $property_enums = CIBlockPropertyEnum::GetList(Array("SORT" => "ASC"), Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "CODE" => "payment"));
        while ($enum_fields = $property_enums->GetNext()) {
            $propPaymentArr[$enum_fields["XML_ID"]] = $enum_fields;
        }
        $arrElementProps["payment"] = false;
        if($arFields["UF_PAYMENT"]) {
            foreach ($arFields["UF_PAYMENT"] as $val) {
                if ($val) {
                    $val_xml_id = $paymentSectionArrByID[$val]["XML_ID"];
                    $arrElementProps["payment"][] = $propPaymentArr[$val_xml_id]["ID"];
                }

            }
        }
        //UF_LOCALITY_NAME
        if($arFields["UF_LOCALITY_NAME"]){
            $code = "locality-name_".CUtil::Translit($arFields["UF_LOCALITY_NAME"], "ru", array("replace_space" => "-", "replace_other" => "-"));
            if($propFilterArr[$code]) {
                $arrElementProps["filter"][] = $propFilterArr[$code]["ID"];
            }else{
                $ID = addFilterValue("locality-name", $arFields["UF_LOCALITY_NAME"]);
                $arrElementProps["filter"][] = $ID;
            }
            $arrElementProps["locality_name"] = $arFields["UF_LOCALITY_NAME"];
        }else{
            $arrElementProps["locality_name"] = "";
        }
        //UF_SUB_LOCALITY_NAME
        if($arFields["UF_SUB_LOCALITY_NAME"]){
            $code = "sub-locality-name_".CUtil::Translit($arFields["UF_SUB_LOCALITY_NAME"], "ru", array("replace_space" => "-", "replace_other" => "-"));
            if($propFilterArr[$code]) {
                $arrElementProps["filter"][] = $propFilterArr[$code]["ID"];
            }else{
                $ID = addFilterValue("sub-locality-name", $arFields["UF_SUB_LOCALITY_NAME"]);
                $arrElementProps["filter"][] = $ID;
            }
            $arrElementProps["sub_locality_name"] = $arFields["UF_SUB_LOCALITY_NAME"];
        }else{
            $arrElementProps["sub_locality_name"] = "";
        }
        //UF_DISTRICT
        if($arFields["UF_DISTRICT"]){
            $code = "district_".CUtil::Translit($arFields["UF_DISTRICT"], "ru", array("replace_space" => "-", "replace_other" => "-"));
            if($propFilterArr[$code]) {
                $arrElementProps["filter"][] = $propFilterArr[$code]["ID"];
            }else{
                $ID = addFilterValue("district", $arFields["UF_DISTRICT"]);
                $arrElementProps["filter"][] = $ID;
            }
            $arrElementProps["district"] = $arFields["UF_SUBLOCALITY"];
        }else{
            $arrElementProps["district"] = "";
        }
        //UF_DEVELOPER
        if($arFields["UF_DEVELOPER"]){
            $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>DEVELOPER_IBLOCK_ID, "ACTIVE"=>"Y"), false, Array(), Array("ID", "NAME", "XML_ID"));
            while($ob = $res->GetNextElement()) {
                $arDevFields = $ob->GetFields();
                $propDevArr[$arDevFields["ID"]] = $arDevFields;
            }
            $value = $propDevArr[$arFields["UF_DEVELOPER"]]["NAME"];
            $code = "developer_".CUtil::Translit($value, "ru", array("replace_space" => "-", "replace_other" => "-"));
            if($propFilterArr[$code]) {
                $arrElementProps["filter"][] = $propFilterArr[$code]["ID"];
            }else{
                $ID = addFilterValue("developer", $value);
                $arrElementProps["filter"][] = $ID;
            }
        }
        //UF_REGION
        if($arFields["UF_REGION"]){
            $arrElementProps["region"] = $arFields["UF_REGION"];
        }else{
            $arrElementProps["region"] = "";
        }
        //UF_BANKS
        if($arFields["UF_BANKS"]){
            foreach ($arFields["UF_BANKS"] as $bank) {
                if($bank)
                    $arrElementProps["developer"] = $arFields["UF_DEVELOPER"];
            }

        }else{
            $arrElementProps["district"] = "";
        }
        $arSelect = Array("ID", "NAME");
        $arFilter = Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "ACTIVE" => "Y", "IBLOCK_SECTION_ID" => $SECTION_ID);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields2 = $ob->GetFields();
            CIBlockElement::SetPropertyValuesEx($arFields2["ID"], false, $arrElementProps);
        }


    }

}


function CleanUpUpload() {

    global $DB;

    define("NO_KEEP_STATISTIC", true);
    define("NOT_CHECK_PERMISSIONS", true);
    $deleteFiles = 'yes'; //Удалять ли найденые файлы yes/no
    $saveBackup = 'no'; //Создаст бэкап файла yes/no
    //Папка для бэкапа
    $patchBackup = $_SERVER['DOCUMENT_ROOT'] . "/upload/iblock_Backup/";
    //Целевая папка для поиска файлов
    $rootDirPath = $_SERVER['DOCUMENT_ROOT'] . "/upload/iblock";

    $time_start = microtime(true);

    //Создание папки для бэкапа
    if (!file_exists($patchBackup)) {
        CheckDirPath($patchBackup);
    }
    // Получаем записи из таблицы b_file
    $arFilesCache = array();
    $result = $DB->Query('SELECT FILE_NAME, SUBDIR FROM b_file WHERE MODULE_ID = "iblock"');
    while ($row = $result->Fetch()) {
        $arFilesCache[$row['FILE_NAME']] = $row['SUBDIR'];
    }
    $hRootDir = opendir($rootDirPath);
    $count = 0;
    $contDir = 0;
    $countFile = 0;
    $i = 1;
    $removeFile=0;
    while (false !== ($subDirName = readdir($hRootDir))) {
        if ($subDirName == '.' || $subDirName == '..') {
            continue;
        }
        //Счётчик пройденых файлов
        $filesCount = 0;
        $subDirPath = "$rootDirPath/$subDirName"; //Путь до подкатегорий с файлами
        $hSubDir = opendir($subDirPath);
        while (false !== ($fileName = readdir($hSubDir))) {
            if ($fileName == '.' || $fileName == '..') {
                continue;
            }

            $countFile++;
            if (array_key_exists($fileName, $arFilesCache)) { //Файл с диска есть в списке файлов базы - пропуск
                $filesCount++;
                continue;
            }
            echo $fileName;
            $fullPath = "$subDirPath/$fileName"; // полный путь до файла
            $backTrue = false; //для создание бэкапа
            if ($deleteFiles === 'yes') {
                if (!file_exists($patchBackup . $subDirName)) {
                    if (CheckDirPath($patchBackup . $subDirName . '/')) { //создал поддиректорию
                        $backTrue = true;
                    }
                } else {
                    $backTrue = true;
                }
                if ($backTrue) {
                    if ($saveBackup === 'yes') {
                        CopyDirFiles($fullPath, $patchBackup . $subDirName . '/' . $fileName); //копия в бэкап
                    }
                }
                //Удаление файла
                if (unlink($fullPath)) {
                    echo $fullPath;
                    $removeFile++;
                }
            } else {
                $filesCount++;
            }
            $i++;
            $count++;
            unset($fileName, $backTrue);
        }
        closedir($hSubDir);
        //Удалить поддиректорию, если удаление активно и счётчик файлов пустой - т.е каталог пуст
        if ($deleteFiles && !$filesCount) {
            rmdir($subDirPath);
        }
        $contDir++;
    }
    closedir($hRootDir);
    echo $removeFile;
    return "CleanUpUpload();";
}

function addCodeFunction(&$arFields)
{
    if(in_array($arFields["IBLOCK_ID"], array(CATALOG_IBLOCK_ID, DEVELOPER_IBLOCK_ID, BANKS_CATALOG_ID))) {
        $arParams = array(
            "max_len" => "60", // обрезаем символьный код до 60 символов
            "change_case" => "L", // приводим к нижнему регистру
            "replace_space" => "-", // меняем пробелы на тире
            "replace_other" => "-", // меняем плохие символы на тире
            "delete_repeat_replace" => "true", // удаляем повторяющиеся тире
            "use_google" => "false", // отключаем использование google
        );
        $arFields["CODE"] = Cutil::translit($arFields["NAME"], "ru", $arParams);
        $arFields["CODE"] = $arFields["CODE"];

    }
}

function updatePrice(&$arFields){
    if($arFields["IBLOCK_ID"] == CATALOG_IBLOCK_ID && $arFields["RESULT"]){

        if($arFields["PROPERTY_VALUES"][27][$arFields["ID"].":27"]["VALUE"]) {
            $price = $arFields["PROPERTY_VALUES"][27][$arFields["ID"] . ":27"]["VALUE"];
            $sectionID = $arFields["IBLOCK_SECTION"][0];
            if($sectionID){
                $uf_arresult = CIBlockSection::GetList(Array(), Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "ID" => $sectionID), false, array("UF_MIN_PRICE"));
                if ($uf_value = $uf_arresult->GetNext()) {
                    if ($price > $uf_value["UF_MIN_PRICE"]) {
                        $bs = new CIBlockSection;
                        $bs->Update($sectionID, array("UF_MIN_PRICE" => $price));
                    }
                }
            }
        }
        if($arFields["PROPERTY_VALUES"]["price_discount"]) {
            $price = $arFields["PROPERTY_VALUES"]["price_discount"];
            $sectionID = $arFields["IBLOCK_SECTION"][0];
            if ($sectionID) {
                $uf_arresult = CIBlockSection::GetList(Array(), Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "ID" => $sectionID), false, array("UF_MIN_PRICE"));
                if ($uf_value = $uf_arresult->GetNext()) {
                    if ($price > $uf_value["UF_MIN_PRICE"]) {
                        $bs = new CIBlockSection;
                        $bs->Update($sectionID, array("UF_MIN_PRICE" => $price));
                    }
                }
            }
        }
    }
}

function setMinReadyDate($sectionID){
    if (CModule::IncludeModule("iblock")) {
        $arSelect = Array("ID", "NAME", "PROPERTY_ready");
        $arFilter = Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "ACTIVE" => "Y", "IBLOCK_SECTION_ID" => $sectionID);
        $res = CIBlockElement::GetList(Array("PROPERTY_ready" => "ASC"), $arFilter, array("PROPERTY_ready"), Array(), $arSelect);
        if ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $ready = $arFields["PROPERTY_READY_VALUE"];
            if($ready>0){
                $bs = new CIBlockSection;
                $bs->Update($sectionID, array("UF_READY_MIN" => $ready));
            }
        }

    }
}
function setMinReadyDateAll(){
    if (CModule::IncludeModule("iblock")) {
        $res = CIBlockSection::GetList(Array(), Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "ACTIVE" => "Y"), false, array());
        while($arSection = $res->GetNext()) {
            $sectionID = $arSection["ID"];
            setMinReadyDate($sectionID);
        }
    }
}

function setMinPrice($sectionID){
    if (CModule::IncludeModule("iblock")) {
        $arSelect = Array("ID", "NAME", "PROPERTY_price_discount");
        $arFilter = Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "ACTIVE" => "Y", "IBLOCK_SECTION_ID" => $sectionID, ">PROPERTY_price_discount" => 0);
        $res = CIBlockElement::GetList(Array("PROPERTY_price_discount" => "ASC"), $arFilter, array("PROPERTY_price_discount"), Array(), $arSelect);
        if ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $minDiscountPrice = $arFields["PROPERTY_PRICE_DISCOUNT_VALUE"];
        }
        $arSelect = Array("ID", "NAME", "PROPERTY_price_base");
        $arFilter = Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "ACTIVE" => "Y", "IBLOCK_SECTION_ID" => $sectionID, ">PROPERTY_price_base" => 0);
        $res = CIBlockElement::GetList(Array("PROPERTY_price_base" => "ASC"), $arFilter, array("PROPERTY_price_base"), Array(), $arSelect);
        if ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $minPrice = $arFields["PROPERTY_PRICE_BASE_VALUE"];
        }
        $price = ($minDiscountPrice > $minPrice ? $minPrice : $minDiscountPrice);
        $bs = new CIBlockSection;
        $bs->Update($sectionID, array("UF_MIN_PRICE" => $price));
    }
}

function setMinPriceAll(){
    if (CModule::IncludeModule("iblock")) {
        $res = CIBlockSection::GetList(Array(), Array("IBLOCK_ID" => CATALOG_IBLOCK_ID, "ACTIVE" => "Y"), false, array());
        while($arSection = $res->GetNext()) {
            $sectionID = $arSection["ID"];
            setMinPrice($sectionID);
        }
    }
}




require_once "include/xml_reader.php";

function DirFilesR($dir)
{
    $handle = opendir($dir) or die("Can't open directory $dir");
    $files = Array();
    $subfiles = Array();
    while (false !== ($file = readdir($handle)))
    {
      if ($file != "." && $file != "..")
      {
          $files[] = $file;
      }
    }

    closedir($handle);
    return $files;
  }
define("PATH_TO_404", "/404.php");
AddEventHandler("main", "OnEpilog", "Redirect404");
function Redirect404() {
    if(
        !defined('ADMIN_SECTION') &&
        defined("ERROR_404") &&
        defined("PATH_TO_404") &&
        file_exists($_SERVER["DOCUMENT_ROOT"].PATH_TO_404)
    ) {
        //LocalRedirect("/404.php", "404 Not Found");
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        CHTTP::SetStatus("404 Not Found");
        include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/header.php");
        include($_SERVER["DOCUMENT_ROOT"].PATH_TO_404);
        include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/footer.php");
    }
}





AddEventHandler("main", "OnUserTypeBuildList", array("CUserTypeIBlockElementBySection", "GetUserTypeDescription"));
?>