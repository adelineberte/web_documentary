<?php

// Namespaces
use \Documentary\Models      as DM;
use \Documentary\Views       as DV;
use \Documentary\Controllers as DC;

// Container
$container = $app->getContainer();

// View
$container['view'] = function($container)
{
    // Initialize views
    $view   = new \Slim\Views\Twig('../includes/views');
    $router = $container->get('router');
    $uri    = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $view;
};

// Database
$container['database'] = function($container)
{
    // Connect to database
    $db  = $container['settings']['database'];
    $pdo = new PDO('mysql:host='.$db['host'].';dbname='.$db['name'].';port='.$db['port'], $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Connect to database
    $database = new DM\Database($pdo);

    return $database;
};

// Chapters
$container['chapters'] = function($container)
{
    $chapter_1 = 
    [
        'number'    => 1,
        'title'     => 'Voyage au fil<br>de l\'eau',
        'paragraph' => 'L\'eau qui coule de nos robinets semble infinie mais cette ressource naturelle se transforme peu à peu en valeur marchande.',
        'section'   => 'États des lieux',
        'slug'      => 'introduction',
        'header'    =>
        [
            'title' => 'La quantité d\'eau<br>à la surface de la Terre',
            'text'  => 'L\'eau qui coule de nos robinets semble infinie, mais cette<br>ressource naturelle se transforme peu à peu en valeur marchande.',
        ],
        'slides'    =>
        [
            'slide_1' => 
            [
                'type'  => 'video',
                'video' => 'motion1.mp4',
            ],
            'slide_2' => 
            [
                'type' => 'threeBars',
                'bars' =>
                [
                    'bar_1' =>
                    [
                        'title'  => 'Géants de l\'eau',
                        'number' => '60 %',
                        'fill'   => '60',
                        'text'   => 'des ressources naturelles d\'eau douce sont partagées entre 9 pays. Le monde en compte 197.',
                    ],
                    'bar_2' =>
                    [
                        'title'  => 'Inaccessible',
                        'number' => '10 %',
                        'fill'   => '10',
                        'text'   => 'de la population mondiale n\'a pas accès à l\'eau potable. Soit 748 millions d\'humains.',
                    ],
                    'bar_3' =>
                    [
                        'title'  => 'Course contre la montre',
                        'number' => '5 humains',
                        'fill'   => '50',
                        'text'   => 'meurent toutes les minutes parce qu\'ils n\'ont pas accès à l\'eau potable.',
                    ],
                ],
            ],
        ],
    ];

    $chapter_2 =
    [
        'number'    => 2,
        'title'     => 'L\'or bleu<br>la bataille de l\'eau',
        'paragraph' => 'Entre agriculture, industrie et quotidien, la quantité<br>d\'eau a drastiquement diminué au cours de ces dernières années.',
        'section'   => 'Utilisation de l\'eau',
        'slug'      => 'utilisation',
        'header'    =>
        [
            'title' => 'L\'utilisation de l\'eau<br>dans nos sociétés',
            'text'  => 'Entre agriculture, industrie et quotidien, la quantité<br>d\'eau a drastiquement diminué au cours de ces dernières années.',
        ],
        'slides'    =>
        [
            'slide_1' =>
            [
                'type'     => 'threeCircles',
                'circles'  =>
                [
                    'circle_1' =>
                    [
                        'number' => '70',
                        'text'   => 'Agriculture',
                    ],
                    'circle_2' =>
                    [
                        'number' => '20',
                        'text'   => 'Industries',
                    ],
                    'circle_3' =>
                    [
                        'number' => '10',
                        'text'   => 'Humains',
                    ],
                ],
            ],
            'slide_2' =>
            [
                'type' => 'twoBars',
                'bars' =>
                [
                    'bar_1' =>
                    [
                        'title'  => 'Terres cultivées',
                        'number' => '12 %',
                        'fill'   => '12',
                    ],
                    'bar_2' =>
                    [
                        'title'  => 'Surfaces irriguées',
                        'number' => '117 %',
                        'fill'   => '117',
                    ],
                ],
                'popups' =>
                [
                    'popup_1' =>
                    [
                        'question' => 'Comment l\'expliquer ?',
                        'text'     => 'L\'irrigation constitue un outil de gestion efficace contre les aléas des précipitations. Elle permet de choisir des variétés à haut <span class="text-bold">rendement</span> en appliquant les fertilisants et traitements nécessaires.<br>L\'irrigation rend ces cultures économiquement intéressantes, et a pour effet de favoriser l\'augmentation des rendements.',
                    ],
                    'popup_2' =>
                    [
                        'question' => 'Quelles conséquences ?',
                        'text'     => 'Il y a des conséquences importantes sur la <span class="text-bold">pollution</span> des eaux des nappes et des rivières avec de fortes concentrations en <span class="text-bold">azote</span> et en <span class="text-bold">molécules</span> issues des produits phytosanitaires, ainsi qu\'en phosphore dans certaines zones.',
                    ],
                ],
            ],
            'slide_3' =>
            [
                'type' => 'twoBars',
                'bars' =>
                [
                    'bar_1' =>
                    [
                        'title'  => 'REFROIDISSMENT RÉACTEURS',
                        'number' => '66 %',
                        'fill'   => '66',
                        'text'   => 'de l\'eau utilisée par le secteur industriel est pour le refroidissment des réacteurs',
                    ],
                    'bar_2' =>
                    [
                        'title'  => 'PRODUCTION ENERGIE',
                        'number' => '34 %',
                        'fill'   => '34',
                        'text'   => 'de l\'eau sert à la production d\'énergie.',
                    ],
                ],
                'popups' =>
                [
                    'popup_1' =>
                    [
                        'question' => 'EN TURQUIE',
                        'text'     => 'En 2013, le gouvernement turc a <span class="text-bold">privatisé</span> le secteur de l\'hydroélectricité. Depuis, tous les cours d\'eau du pays sont <span class="text-bold">accaparés</span> forçant les populations à se déplacer.',
                    ],
                    'popup_2' =>
                    [
                        'question' => 'AU MEXIQUE',
                        'text'     => 'Le géant américain, <span class="text-bold">Coca-Cola</span> engloutit <span class="text-bold">100 millions</span> de litres par an. Alors que <span class="text-bold">12 millions</span> d\'habitants n\'ont pas accès à l\'eau potable dans ce même pays.',
                    ],
                ],
            ],
            'slide_4' =>
            [
                'type'   => 'fiveCircles',
                'circles' =>
                [
                    'circle_1' =>
                    [
                        'subtitle' => 'Boisson',
                        'number'   => '1-3 L',
                    ],
                    'circle_2' =>
                    [
                        'subtitle' => 'Chasse d\'eau',
                        'number'   => '4-10 L',
                    ],
                    'circle_3' =>
                    [
                        'subtitle' => 'Douche',
                        'number'   => '30-80 L',
                    ],
                    'circle_4' =>
                    [
                        'subtitle' => 'Lave-linge',
                        'number'   => '120 L',
                    ],
                    'circle_5' =>
                    [
                        'subtitle' => 'Bain',
                        'number'   => '150-200 L',
                    ],
                ],
            ],
        ],
    ];

    $chapter_3 =
    [
        'number'    => 3,
        'title'     => 'Gestion publique,<br> gestion privée ?',
        'paragraph' => 'On ne fabrique pas l’eau, on ne fait que partager celle qui<br>nous entoure. Qui détermine ce partage et comment est-il fait ?',
        'section'   => 'Gestion publique ou privée',
        'slug'      => 'gestion-publique-privee',
        'header'    =>
        [
            'title' => 'Gestion publique,<br> gestion privée ?',
            'text'  => 'On ne fabrique pas l’eau, on ne fait que partager celle qui<br>nous entoure. Qui détermine ce partage et comment est-il fait ?',
        ],
        'slides'    =>
        [
            'slide_1' =>
            [
                'type'  => 'video',
                'video' => 'documentaire.mp4',
            ],
            'slide_2' =>
            [
                'type'  => 'text',
                'title' => 'FLUCTUACT NEC MERGITUR',
                'label' => '« il est battu par les flots mais ne sombre pas »',
                'text'  => 'Aujourd\'hui, la mairie de <span class="text-bold">Paris</span> affiche comme un succès le fait d\'avoir fait baisser le prix du mètre cube d\'eau. En revanche et en parallèle de cette baisse, les Parisiens ont pu constater une réelle <span class="text-bold">augmentation</span> de leurs impôts locaux.',
            ],
            'slide_3' =>
            [
                'type'   => 'text',
                'button' => 'Le voyage politique de l\'eau',
                'images' =>
                [
                    'images_1' => 'paris_1.jpg',
                    'images_2' => 'paris_2.jpg',
                ],
                'popups' =>
                [
                    'popup' =>
                    [
                        'title' => 'Le voyage politique de l\'eau',
                        'text'  => 'En 2009, les parisiens ont connu une hausse en moyenne de <span class="text-bold">11,7%</span> ( 395 euros en moyenne) pour la taxe d\'habitation et de <span class="text-bold">47%</span> ( 552 euros en moyenne ) pour la taxe foncière. Dire que le passage de Paris en <span class="text-bold">régie publique</span> est la seule conséquence de l\'augmentation des impôts serait un raccourci trop facile, néanmoins le lien paraît évident.<br>En réalité, le coût dépend surtout de la <span class="text-bold">facilité d\'accès</span> aux points d\'approvisionnement en eau et de la <span class="text-bold">qualité</span> de cette eau. C\'est pour cette raison que les prix peuvent varier de 2,50 à 15€ le mètre cube rien qu\'en France.<br>Ce choix est également très politique, et il en va de la <span class="text-bold">réappropriation</span> du service public pour certains.',
                    ],
                ],
            ],
            'slide_4' =>
            [
                'type'       => 'character',
                'characters' =>
                [
                    'character_1' =>
                    [
                        'name'        => 'PIERRE MOSCOVICI',
                        'description' => 'Président de l\'agglomération du Pays de Montbéliard, il avait annoncé en <span class="text-bold">2010</span> le retour en régie de la gestion de l\'eau d\'ici 2015… alors que le contrat courait jusqu\'en <span class="text-bold">2022</span>, n\'en déplaise à Veolia.<br>Certains estiment que se prononcer en faveur de la gestion en régie, et donc contre la mainmise des groupes privés, reste une <span class="text-bold">manoeuvre électoraliste</span> efficace pour apaiser les ardeurs des Verts et redorer son blason socialiste. Pourtant, si le combat semble plus porté par la gauche, la gestion est une question qui dépasse bel et bien le clivage politique droite-gauche.',
                    ],
                    'character_2' =>
                    [
                        'name'        => 'BERTRAND DELANÖE',
                        'description' => 'Bertrand Delanoë en avait fait son cheval de bataille pour sa réélection à la Mairie de Paris en 2008. En réaffirmant, ce besoin de la puissance des collectivités locales face aux entreprises privées, motivé par un attachement certain au service public.<br><span class="text-bold">Olivier Galiana</span>, directeur du cabinet de la communauté d\'agglomération d\'Evry le disait : "La distribution d\'eau sera gérée par une régie publique et non plus par Suez car nous visons à nous réapproprier le service public de proximité.”',
                    ],
                    'character_3' =>
                    [
                        'name'        => 'ANNE LE STRAT',
                        'description' => 'D\'après Anne Le Strat, adjointe PS à la mairie de Paris <span class="text-bold">chargée de l\'eau</span> :<br>"Quand on regarde la carte de France de plus près, on voit que certaines villes de gauche ont décidé de rester délégataires tandis que des villes de droite ont cassé leur contrat pour passer en régie. Il faut donc se garder de tout raisonnement simpliste selon lequel les municipalités de gauche seraient plus favorables à une gestion publique que celles de droite.”',
                    ],
                ],
            ],
            'slide_5' =>
            [
                'type'  => 'audio',
                'title' => 'LES DIFFÉRENTES POLITIQUES DE L\'EAU',
                'text'  => 'Découverte de la gestion de l\'eau avec<br>les grands géants de ce monde',
            ],
        ],
    ];

    $chapter_4 =
    [
        'number'    => 4,
        'title'     => 'Limites et avantages<br>de la gestion',
        'paragraph' => 'Chaque minute, cinq personnes meurent dans le monde parce qu\'elles n\'ont pas accès à l\'eau potable.',
        'section'   => 'Limites et avantages',
        'slug'      => 'limites-avantages',
        'header'    =>
        [
            'title' => 'Les limites et les avatanges<br>de la gestion de l\'eau',
            'text'  => 'Chaque minute, cinq personnes meurent dans le monde parce qu\'elles n\'ont pas accès à l\'eau potable.',
        ],
        'slides' =>
        [
            'slide_1' =>
            [
                'type' => 'map',
            ],
        ],
    ];

    $chapter_5 =
    [
        'number'    => 5,
        'title'     => 'Droit ou besoin<br>le statut de l\'eau',
        'paragraph' => 'L’eau est vitale au développement humain. Sans eau pas, de vie.<br>Pourtant, 1,4 milliards de personnes sont privées d’eau.',
        'section'   => 'Droit ou besoin',
        'slug'      => 'droit-ou-besoin',
        'header'    =>
        [
            'title' => 'L\'eau est-elle<br>un droit ou un bien ?',
            'text'  => 'L’eau est vitale au développement humain. Sans eau pas, de vie.<br>Pourtant, 1,4 milliards de personnes sont privées d’eau.',
        ],
        'slides'    =>
        [
            'slide_1' =>
            [
                'type'  => 'video',
                'video' => 'motion5.mp4',
            ],
            'slide_2' =>
            [
                'type'   => 'text',
                'title'  => 'La ruee vers l\'or',
                'label'  => 'UNE AFFOLANTE COURSE VERS L\'EAU',
                'text'   => 'Si aujourd\'hui l\'eau potable est abondante, et <span class="text-bold">70%</span> des personnes qui vivent sur Terre y ont accès, cela ne sera plus le cas dans quelques temps. Selon une étude des Nations Unies, l\'eau pourrait devenir, d\'ici à <span class="text-bold">50 ans</span>, un bien plus précieux que le pétrole.',
                'button' => 'Quel avenir ?',
                'popups' =>
                [
                    'popup' =>
                    [
                        'title' => 'Quel avenir ?',
                        'text'  => 'Si l’eau venait à devenir un <span class="text-bold">actif financier</span>, la spéculation sur les prix de l’eau potable pourrait être <span class="text-bold">catastrophique</span> pour les pays du tiers monde.<br><br>Pourtant, contrairement aux denrées alimentaires qui nécessite des techniques agricoles particulières, il n’y a quasiment <span class="text-bold">aucun surcoût</span> pour l’eau potable. C’est d’ailleurs l’un des arguments majeurs luttant contre la privatisation de l’eau. Cette action pourrait <span class="text-bold">tuer</span> des millions d’êtres humains sur la planète.<br><br>Mais la raréfaction de cette ressource, les tensions qu’elle provoque, pousse de plus en plus d’acteurs à réfléchir à la financiarisation de l’eau.',
                    ],
                ],
            ],
            'slide_3' =>
            [
                'type'        => 'video',
                'video'       => 'nestlé.mp4',
                'title'       => 'NESTLÉ, PRIVATISER L\'EAU POUR MIEUX LA RÉPARTIR',
                'text'        => '« We feed the world » - 2005 - Erwin Wagenhofer<br>Interview du président de Nestlé, Peter Brabeck',
                'button'      => 'EN SAVOIR PLUS',
                'name'        => 'Nestlé',
                'description' => 'Après l\'énorme mouvement collectif d\'<span class="text-bold">indignation</span> et de colère que provoqua cette déclaration. Nestlé publia bon nombre de communiqué de presse et M. Brabeck fit quelques autres sorties remarquées pour clarifier son point de vue. Pour Nestlé, comme pour les <span class="text-bold">Nations Unies</span> :<br>« Notre planète dispose de suffisamment d\'eau fraîche pour couvrir les besoins de 7 milliards de personnes, mais ces ressources sont inégalement réparties. Une quantité malheureusement trop importante d\'eau est gaspillée, polluée et utilisée de façon non durable. »<br>Nestlé souhaite <span class="text-bold">privatiser</span> l\'eau dans le but de mieux la répartir, de manière triviale en empêchant les plus fortunés de remplir leurs piscines et les plus nécessiteux d\'avoir accès à l\'eau. Celle-ci devrait avoir une valeur en termes de <span class="text-bold">taxation</span> afin que chacun continue à l\'utiliser de façon responsable.',
            ],
            'slide_4' =>
            [
                'type'  => 'text',
                'title' => 'CONFLITS MILITAIRES',
                'label' => '« EAU RAGE, EAU DÉSESPOIR »',
                'text'  => 'L\'accès à l\'eau pourrait devenir l\'une des premières causes de <span class="text-bold">tensions internationales</span>. Plus de 40 % de la population mondiale est établie dans les <span class="text-bold">250 bassins</span> fluviaux transfrontaliers du globe. Elles ont toutes l\'obligation de partager leurs ressources en eau avec les habitants d\'un pays voisin.',
            ],
            'slide_5' =>
            [
                'type'         => 'text',
                'title'        => 'CONFLITS MILITAIRES',
                'label'        => '« EAU RAGE, EAU DÉSESPOIR »',
                'text'         => 'Une telle situation peut être à l\'origine de <span class="text-bold">conflits</span> récurrents, notamment lorsqu\'un cours d\'eau traverse une frontière, car l\'eau devient alors un véritable <span class="text-bold">instrument de pouvoir</span> aux mains du pays situé en amont. Qu\'il soit puissant ou non, celui-ci a toujours théoriquement l\'avantage, puisqu\'il a la maîtrise du débit de l\'eau.',
                'button'       => 'HISTOIRE DE POUVOIR',
                'popups' =>
                [
                    'popup_1' =>
                    [
                        'title' => 'Suivre le nil',
                        'text'  => 'L\'Égypte, entièrement tributaire du Nil pour ses ressources en eau, doit néanmoins partager celles-ci avec <span class="text-bold">10</span> autres États du bassin du Nil : notamment avec l\'<span class="text-bold">Ethipie</span> où le Nil bleu prend sa source, et avec le <span class="text-bold">Soudan</span> où le fleuve serpente avant de déboucher sur le territoire égyptien.',
                        'image' => 'nil.jpg',
                    ],
                    'popup_2' =>
                    [
                        'title' => 'La Turquis',
                        'text'  => 'Quant à l\'<span class="text-bold">Irak</span> et à la <span class="text-bold">Syrie</span>, ils sont tous deux à la merci de la <span class="text-bold">Turquie</span>, où les deux fleuves qui les alimentent, le Tigre et l\'Euphrate, prennent leur source. L\'eau de l\'Euphrate a d\'ailleurs souvent servi d\'arme brandie par la Turquie contre ses deux voisins : grâce aux nombreux barrages qu\'elle a érigés sur le cours supérieur du fleuve et qui lui permettent d\'en réguler à sa guise le débit en aval, la Turquie possède là, en effet, un puissant moyen de pression.',
                        'image' => 'tigre.jpg',
                    ],
                    'popup_3' =>
                    [
                        'title' => 'Quel avenir ?',
                        'text'  => 'Avec l\'essor démographique et l\'accroissement des besoins, ces tensions pourraient se multiplier à l\'avenir. C\'est ce que prédisent certains experts pour le XXIe siècle. D\'autres en revanche pensent que la gestion commune de l\'eau peut être un facteur de pacification. Ils mettent en avant des exemples étonnants de coopération : le plus fameux est celui de l\'Inde et du Pakistan qui, au plus fort de la guerre qui les opposait dans les années 1960, n\'ont jamais interrompu le financement des travaux d\'aménagement qu\'ils menaient en commun sur le fleuve Indus.',
                        'image' => 'euphrate.jpg',
                    ],
                ],
            ],
            'slide_6' => 
            [
                'type' => 'threeBars',
                'bars' =>
                [
                    'bar_1' =>
                    [
                        'title'  => 'CROISSANCE',
                        'number' => '458 milliards',
                        'fill'   => '60',
                        'text'   => 'd\'euros de perte, voilà ce que représente la pénurie d\'eau, soit 1% du PIB mondial.',
                    ],
                    'bar_2' =>
                    [
                        'title'  => 'SANTÉ, DANGER',
                        'number' => '3,5 milliards',
                        'fill'   => '80',
                        'text'   => 'de la population mondiale boivent une eau dangereuse pour leur santé.',
                    ],
                    'bar_3' =>
                    [
                        'title'  => 'CONTAMINATION',
                        'number' => '1,8 milliards',
                        'fill'   => '50',
                        'text'   => 'd\'humains s\'abreuvent à des points d\'eau contaminés par les matières fécales, etc.',
                    ],
                ],
                'button'      => 'EN SAVOIR PLUS',
                'name'        => 'EAU, INFINI ESPOIR',
                'description' => '<p>Alors que se profile une <span class="text-bold">pénurie</span> mondiale, la question de la gestion de l’eau n’est presque pas posée. Nous n’avons toujours pas su définir ce que l’eau était pour l’homme en termes de <span class="text-bold">droit international</span>, nous n’avons pas réglé le problème de <span class="text-bold">répartition</span> de l’eau dans le monde, ains que celui du problème de la <span class="text-bold">qualité</span> de l’eau dans le monde.</p><p>L’eau, <span class="text-bold">illusion</span> parfaite d’une ressource infinie, est aujourd’hui le dernier de nos soucis. Par manque de vision à long-terme et de prévoyance, il pourrait bien devenir le premier très rapidement, et ainsi s’ajouter à la longue liste de ce que la civilisation humaine aurait pu éviter.</p>',
            ],
            'slide_7' =>
            [
                'type'  => 'text',
                'title' => 'À MÉDITER',
                'label' => 'Antoine de Saint-Exupéry',
                'text'  => '« Eau, tu n\'as ni goût, ni couleur, ni arôme, on ne peut pas te définir, on te goûte, sans te connaître. Tu n\'es pas nécessaire à la vie : tu es la vie. »',
            ],
        ],
    ];

    $chapters = [$chapter_1, $chapter_2, $chapter_3, $chapter_4, $chapter_5];

    return $chapters;
};