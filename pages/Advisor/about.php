<?php
include_once '../../php/check.php';
include '../../php/navbar.php';
check();
check_activity();
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="shortcut icon" href="../../assets/images/logo.png">
    <link rel="stylesheet" href="../../css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="../../css/Advisor/about.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php echo generateNavbar($links = array(
        array("label" => "النماذج", "url" => "report.php"),
        array("label" => "الطلاب", "url" => "student.php"),
        array("label" => "الرئيسية", "url" => "home.php")
    ), "مرشد"); ?>
    <div class="landing">
        <div class="container">
            <div class="row shadow-lg p-3 mb-4 bg-body rounded">
                <div class="col">
                    <ul class="nav nav-tabs" dir="rtl" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <input type="radio" class="btn-check" id="introduction" name="report" autocomplete="off" data-bs-toggle="tab" data-bs-target="#introduction-pane" role="tab" aria-controls="introduction-pane" aria-selected="true">
                            <label class="nav-link btn btn-outline-primary border-primary nav-button-primary me-1 rounded-0 rounded-top" for="introduction">المقدمة</label>
                        </li>
                        <li class="nav-item" role="presentation">
                            <input type="radio" class="btn-check" id="principles-academic" name="report" autocomplete="off" data-bs-toggle="tab" data-bs-target="#principles-academic-pane" role="tab" aria-controls="principles-academic-pane" aria-selected="false">
                            <label class="nav-link btn btn-outline-primary border-primary nav-button-primary me-1 rounded-0 rounded-top" for="principles-academic">مبادئ الإرشاد الأكاديمي</label>
                        </li>
                        <li class="nav-item" role="presentation">
                            <input type="radio" class="btn-check" id="student-rights" name="report" autocomplete="off" data-bs-toggle="tab" data-bs-target="#student-rights-pane" role="tab" aria-controls="student-rights-pane" aria-selected="false">
                            <label class="nav-link btn btn-outline-primary border-primary nav-button-primary me-1 rounded-0 rounded-top" for="student-rights">حقوق الطالب في عملية الإرشاد الأكاديمي</label>
                        </li>
                        <li class="nav-item" role="presentation">
                            <input type="radio" class="btn-check" id="student-responsibility" name="report" autocomplete="off" data-bs-toggle="tab" data-bs-target="#student-responsibility-pane" role="tab" aria-controls="student-responsibility-pane" aria-selected="false">
                            <label class="nav-link btn btn-outline-primary border-primary nav-button-primary me-1 rounded-0 rounded-top" for="student-responsibility"> مسؤولية الطالب في عملية الإرشاد الأكاديمي</label>
                        </li>
                        <li class="nav-item" role="presentation">
                            <input type="radio" class="btn-check" id="Duties-advisor" name="report" autocomplete="off" data-bs-toggle="tab" data-bs-target="#Duties-advisor-pane" role="tab" aria-controls="Duties-advisor-pane" aria-selected="false">
                            <label class="nav-link btn btn-outline-primary border-primary nav-button-primary rounded-0 rounded-top" for="Duties-advisor"> مهام المرشد الأكاديمي </label>
                        </li>
                    </ul>
                    <div class="tab-content pt-3" dir="rtl" id="myTabContent">
                        <div class="tab-pane fade" id="introduction-pane" role="tabpanel" aria-labelledby="introduction" tabindex="0">
                            <p>تُعد الجامعات من أهم مصادر تنمية القوى البشرية القادرة على المساهمة في التنمية الشاملة، فعليها مسؤوليات كبيرة في تربية الطالب الجامعي من جميع جوانب شخصيته: (النفسية، والعقلية، والاجتماعية، والأخلاقية، والأكاديمية، المهنية)، ولها دور قيادي في إعداد القوى البشرية المؤهلة لتلبية احتياجات سوق العمل، وتسعى الجامعة إلى تعزيز نظامها بمجموعة من البرامج الأكاديمية وغير الأكاديمية المساندة لطلابها؛ لتوفير بيئة تعليمية محفزة وجاذبة تضمن للطلبة مقومات النجاح والتوافق في الحياة الجامعية، ومن أهم البرامج الأكاديمية التي تقدمها الجامعة برنامج الإرشاد الأكاديمي، الذي يهدف إلى تنمية شخصية الطالب، ومساعدته في اكتشاف قدراته وميوله، إلى جانب تبصيره بنوعية التخصصات الفعلية المطلوبة لسوق العمل في ضوء احتياجات وخطط وبرامج التنمية المستقبلية، ومؤشرات احتياجات سوق العمل من الخريجين.

                                وإنَ الإرشاد الأكاديمي يمثل ركناً أساسياً ومحورياً، لمواجهة التغيرات والأكاديمية في النظام الجامعي وفلسفته التربوية، وفي ضوء تلك التحديات النفسية، والعلمية، والاجتماعية، والمهنية للطالب الجامعي التي ربما تواجه الطالب، وخلصت الكثير من توصيات الدراسات والأبحاث إلى أنَ هناك ضرورة حتمية للأخذ بنظام الإرشاد الأكاديمي لطلبة الجامعة؛ يتوافق مع حياته الجامعية علمياً ومهنياً.

                                ولهذا تتبنى جامعة الإسراء ضمن برامج خطط إرشادية أكاديمية، وآليات متابعة وتقويم مستمرة تسعى من خلالها إلى تقديم خدمات إرشادية أكاديمية في الجوانب العلمية، والنفسية، والاجتماعية والتربوية كون هذه الجوانب تؤثر في الحياة الجامعية للطالب.

                                ويُعدَ الإرشاد الأكاديمي من البرامج الرئيسة في الجامعات فهو يمنح الطالب الدعم والمساعدة في تحديد مساره الأكاديمي، والمهني، والشخصي وهو جزء لا يتجزأ من عملية التعلم والتعليم، وهو متطلب أساسي لتحقيق أهداف التعليم، وتحفيز مواهب الطالب المتباينة لتنمو نمواً يتناسب مع قدراته، وميوله، وقيم متكاملاً في جميع جوانب شخصيته. ويُعدَ الإرشاد الأكاديمي أحد أهم عوامل نجاح العملية التعليمية، لتنشيط قدرات الطالب في تخصصه، والتعرف إلى المشكلات التي تعوقه في التحصيل العلمي، وتقديم المساعدة له في حلها، وزيادة وعي الطالب بمسؤوليته الأكاديمية.

                                ويعرف الإرشاد الأكاديمي بأنه: «العملية المنظمة والمخطط لها لمساعدة الطالب على مواجهة التحديات التي تقابله في حياته الجامعية، والصعوبات التي تقلل من فاعلية العملية التعليمية»: وهي عملية إنسانية إيجابية بين المرشد (عضو هيئة تدريس)، والمسترشد وهي عملية إنسانية تربوية تفاعلية إي (الطالب الجامعي)، تبدأ من قبول الطالب في المرحلة الجامعية حتى استكمال متطلبات تخرجه، بهدف مساعدته على التوافق في الحياة الجامعية.

                                ويتمثل الإرشاد الأكاديمي في جامعة الإسراء في جملة الخدمات الإرشادية والتوجيهية التي تقدم لطالب الجامعة من قبل وحدة الإرشاد الأكاديمي، والمتخصصين في الإرشاد الأكاديمي، بهدف التغلب على كل ما يواجه الطالب من مشكلات وتحديات تعرقل مسيرته الأكاديمية، ومساعدته على اتخاذ قرارات ذات صلة بمسيرته التعليمية
                            </p>
                        </div>
                        <div class="tab-pane fade" id="principles-academic-pane" role="tabpanel" aria-labelledby="principles-academic" tabindex="0">
                            <p>
                                تستند عملية الإرشاد الأكاديمي الجامعي إلى العديد من المبادئ التي لتفعيل عملية الإرشاد، ومنها: تسهيل وتعزيز عملية التعلم، ومراعاة الفروق الفردية بين الطلبة، بناء وترسيخ علاقة قائمة على الود والاحترام المتبادل، وتوجيه الطالب إلى جهات أخرى عند الحاجة الإرشادية، والأمانة العلمية بنقله، ودعم فلسفة وسياسة الجامعة، والمتابعة المستمرة في تقديم المعلومات، واحترام النصح الأكاديمي، والتواصل والتشاور مع من يخدم العملية الإرشادية بلطف واحترام.
                            </p>
                        </div>
                        <div class="tab-pane fade" id="student-rights-pane" role="tabpanel" aria-labelledby="student-rights" tabindex="0">
                            <ul class="list-group">
                                <li class="list-group-item">احترام الطالب ومعاملته معاملة تربوية تحقق له الأمن والطمأنينة.</li>
                                <li class="list-group-item">المحافظة على سرية وخصوصية محتويات الملف الإرشادي للطالب.</li>
                                <li class="list-group-item">حصول الطالب على نسخة ورقية أو إلكترونية من دليل الإرشاد الأكاديمي ومن الأنظمة والتعليمات واللوائح المنظمة لعملية الإرشاد الأكاديمي في الجامعة.</li>
                                <li class="list-group-item">توعية الطالب بنظام الإرشاد الأكاديمي في الجامعة.</li>
                                <li class="list-group-item">تكليف مرشد أكاديمي لكل طالب عند التحاقه بالكلية حتى تخرجه.</li>
                                <li class="list-group-item">توفير فرص التواصل الدائم مع المرشد الأكاديمي بالطرق المختلفة كالبريد الإلكتروني أو الساعات الإرشادية الأكاديمية.</li>
                                <li class="list-group-item">الحصول على الخدمات الأكاديمية التسجيل، السحب والإضافة، التأجيل وفق التقويم الدراسي الجامعي وبتوجيه، وإرشاد من المرشد الأكاديمي.</li>
                                <li class="list-group-item">إشعار الطالب خطياً بالساعات الإرشادية للمرشد الأكاديمي شريط عدم تعرضها مع جدول الدراسي.</li>
                                <li class="list-group-item">عقد لقاءات، وجلسات فردية وجمعية مع المرشد الأكاديمي وفق خطة إرشادية معتمدة.</li>
                                <li class="list-group-item">إشعار الطالب بكل تغيير أو تعديل في البرنامج الأكاديمي أو الخطة الدراسية أو الجدول الدراسي.</li>
                                <li class="list-group-item">توفير البرامج الإرشادية الأكاديمية الإيمائية والوقائية وال
                                    علاجية.</li>
                                <li class="list-group-item">الرعاية والدعم للطالب حسب حالته الأكاديمية، ومستواه الدراسي، واحتياجاته الشخصية.</li>
                                <li class="list-group-item">مساعدة الطلبة في اكتشاف قدراته، وميوله، وتوجيها تربويا ومهنياً.</li>
                                <li class="list-group-item">إشعار الطالب بكل ما يصدر بحقه من إنذارات أكاديمية، أو مخالفات سلوكية، ومناقشة أسبابها وعلاجها والوقاية منها.</li>
                                <li class="list-group-item">مساعدة الطالب اكتشاف احتياجاته الأكاديمية، والعمل على تلبيتها.</li>
                                <li class="list-group-item">مساعدة الطالب في تحقيق الأمن الأكاديمي، والنفسي، والاجتماعي، والصحي.</li>
                                <li class="list-group-item">حرية التعبير عن الرأي، والاستفسار، والمناقشة العلمية في القضايا المتعلقة بالإرشاد الأكاديمي التي تخصه على أنْ يكون ذلك في حدود السلوكيات اللائقة، ووفق أنظمة الجامعة وتعليماتها.</li>
                                <li class="list-group-item">الإشراف على العملية الإرشادية ومتابعتها وتقيمها من قبل أصحاب الاختصاص.</li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="student-responsibility-pane" role="tabpanel" aria-labelledby="student-responsibility" tabindex="0">
                            <ul class="list-group">
                                <li class="list-group-item">التزام حضور اللقاءات، والجلسات الإرشادية التي تعقد بعد إشعاره بذلك.</li>
                                <li class="list-group-item">متابعة إعلانات الجامعة والكلية التي تعنى ببرامج وخدمات الإرشاد الأكاديمي سواء كانت على موقع الجامعة أو على موقع الكلية أو على لوحات داخلية، أو من خلال رسائل إلكترونية من خلال البريد الإلكتروني أو رسائل على الهاتف أو غيره.</li>
                                <li class="list-group-item">تحري الدقة في إعطاء البيانات الشخصية وبيانات طرق التواصل البريد الإلكتروني، ورقم الهاتف والحرص على تحديثها بشكل دوري.</li>
                                <li class="list-group-item">المسؤولية الكاملة عن: (التسجيل، السحب والإضافة، التأجيل) وفقاً للتشريعات الناظمة لذلك.</li>
                                <li class="list-group-item">المسؤولية الكاملة عن الاجتماع مع المرشد الأكاديمي لمساعدته في إعداد الجدول الدراسي، واختيار المقررات وفقاً للخطة الدراسية، ومعدله التراكمي.</li>
                                <li class="list-group-item">استشارة المرشد الأكاديمي، ووضع خطة دراسية بديلة إذا طرأت ظروف، مثل: السحب، الرسوب، تغير التخصص، لضمان إنهاء كافة متطلبات التخرج في المدة النظامية.</li>
                                <li class="list-group-item">مراجعة المرشد الأكاديمي في جميع المسائل المتعلقة بالمسيرة الأكاديمية، ولا سيما حالات: (التسجيل المبكر، السحب والإضافة، والتأجيل، ويقوم دور المرشد الأكاديمي على التوجيه والإرشاد الأكاديمي).</li>
                                <li class="list-group-item"> إشعار المرشد الأكاديمي بأيِ َ متغيرات تُؤثر في أدائه الأكاديمي أو برنامجه الأكاديمي، أو حياته الجامعية. </li>
                                <li class="list-group-item"> التعاون مع كل محاور الإرشاد الأكاديمي لتقديم المعلومات، والبيانات المناسبة التي تطلبها الخدمة الإرشادية الأكاديمية. </li>
                                <li class="list-group-item">التواصل الدائم مع المرشد الأكاديمي، ولا سيما خلال مدة التسجيل، وقبل إنتهاء مدة السحب، ومع إنتهاء الامتحانات الدورية والنهائية. </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="Duties-advisor-pane" role="tabpanel" aria-labelledby="Duties-advisor" tabindex="0">
                            <p>المرشد الأكاديمي: هو أحد أعضاء هيئة التدريس في الكليات، يكلف من قبل عميد الكلية، ليتولى مهام الإرشاد الأكاديمي المحددة مسبقاً نحو مجموعة من الطلبة، يتابع مسيرتهم العلمية منذ دخولهم الكلية، وحتى يتخرجوا منها، ومن أهمها:</p>
                            <div>
                                <ul class="list-group">
                                    <li class="list-group-item">بناء وترسيخ علاقة طيبة مع الطالب وبقية أطراف العملية الإرشادية.</li>
                                    <li class="list-group-item">حثٌ الطلبة على زيارة الموقع الإلكتروني للجامعة للاطلاع على الأنظمة والتعليمات والنماذج الإرشادية، ومتابعة أخبار الجامعة وأنشطتها وإعلاناتها.</li>
                                    <li class="list-group-item">مساعدة الطلبة في فهم الأنظمة والتعليمات الناظمة لعملية الإرشاد الأكاديمي.</li>
                                    <li class="list-group-item">متابعة الملف الإرشادي للطالب وتغذيته بالأدلة والنماذج والشواهد العلمية.</li>
                                    <li class="list-group-item">إشعار الطالب خطياً بمواعيد الساعات الإرشادية الأكاديمية، وطرق التواصل معهم.</li>
                                    <li class="list-group-item">التقيد بتنفيذ خطة عمل المرشد الأكاديمي وإشعار الطلبة المسترشدين فيها.</li>
                                    <li class="list-group-item">إرشاد الطالب للحصول على الخدمات الأكاديمية بناء على التقويم الجامعي: (تسجيل، سحب وإضافة، تأجيل، تخصص، تحويل، معادلة مواد أو مكافأتها، زيارة).</li>
                                    <li class="list-group-item">الاجتماع مع الطالب قبل انتهاء مدة السحب وبعدها حسب التقويم الدراسي الجامعي.</li>
                                    <li class="list-group-item">الإجابة عن استفسارات وتساؤلات الطالب في حدود عملية الإرشاد الأكاديمي.</li>
                                    <li class="list-group-item">حصر مشكلات الطالب الأكاديمية وغير الأكاديمية والرفع بها إلى منسق الإرشاد الأكاديمي.</li>
                                    <li class="list-group-item">حصر أسماء الطلبة.</li>
                                    <li class="list-group-item"> تنظيم جدول للجلسات الإرشادية الأكاديمية الفردية والجمعية بالتنسيق مع منسق الإرشاد الأكاديمي. </li>
                                    <li class="list-group-item"> مساعدة الطلبة في مطابقة الجدول الدراسي مع الخطة الدراسية. </li>
                                    <li class="list-group-item"> مساعدة الطلبة في فهم نفسه، وطبيعة مشكلاته التي تؤثر على تحصيله العلمي، وكيفية حلها.</li>
                                    <li class="list-group-item"> مساعدة الطلبة في متابعة سجله الأكاديمي حتى استكمال متطلب التخرج في الوقت المحدد. </li>
                                    <li class="list-group-item"> تشجيع الطلبة في المشاركة في الأنشطة الطلابية، والالتحاق باللقاءات، والبرامج التدريبية. </li>
                                    <li class="list-group-item">
                                        <p>إعداد تقرير مفصل عن الحالة الأكاديمية للطالب المسترشد بعد الاختبارات الدورية والنهائية.
                                            - يُعدُ المرشد ملفاً خاصاً للإرشاد الأكاديمي للطلبة، وإذْ يحتوي على:
                                        </p>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>البند</th>
                                                    <th>التفاصيل</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>نشرة تعريفية</td>
                                                    <td>يشمل مفهوم، ومهام، وأهداف الإرشاد الأكاديمية للطلبة.</td>
                                                </tr>
                                                <tr>
                                                    <td>الخطة الدراسية وجدول المواد المطروحة</td>
                                                    <td>يتضمن جدول المواد المقررة للطالب.</td>
                                                </tr>
                                                <tr>
                                                    <td>نماذج الإرشاد الأكاديمي للطلبة</td>
                                                    <td>يشمل نماذج التعليمات الإرشادية للطلبة.</td>
                                                </tr>
                                                <tr>
                                                    <td>معلومات الطالب</td>
                                                    <td>يتضمن نموذج الإرشاد الأكاديمي، تفريغ الخطة، جدول المواد المسجلة للفصل الحالي.</td>
                                                </tr>
                                                <tr>
                                                    <td>تقرير عن عملية الإرشاد الأكاديمي</td>
                                                    <td>يتضمن نماذج الإرشاد الأكاديمي للطلبة، وتوصيات تسجيل المواد، واللقاءات الفردية، وسجل زيارات الطالب، واللقاءات الشهرية، وخطة التعثر الدراسي، والتقرير السنوي.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/all.min.js"></script>
</body>
<script>
    $("#log-out").click(() => {
        $.ajax({
            url: "../../php/forms/logout.php",
            type: "POST",
            success: function(data) {
                if (data === 'success') {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "تم تسجيل الخروج بنجاح",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    setTimeout(function() {
                        window.location.href = "../../index.php";
                    }, 1500);
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "حدث خطأ ما",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            }
        });
    });
    $("#log-out-res").click(() => {
        $.ajax({
            url: "../../php/forms/logout.php",
            type: "POST",
            success: function(data) {
                if (data === 'success') {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "تم تسجيل الخروج بنجاح",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    setTimeout(function() {
                        window.location.href = "../../index.php";
                    }, 1500);
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "حدث خطأ ما",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            }
        });
    });
</script>

</html>