@extends('layouts.app')

@section('breadcrumbs', '')

@section('content')
  <div class="container-fluid">
    <h3 class="mt-3 text-center" id="content">Руководство пользователя приложения "Учет задержанных и длительно
      простаивающих
      вагонов"</h3>
    <hr>
    <div class="row mt-3">
      <div class="col-2">
        <div class="sticky-top pt-2">
          <nav class="nav nav-pills nav-stacked flex-column" id="content-nav">
            <p class="text-center mb-0">Содержание</p>
            <a class="nav-link py-0 active" href="#annotation">Аннотация</a>
            <a class="nav-link py-0" href="#interface">Интерфейс приложения</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 py-0" href="#root-page">Главная страница</a>
              <a class="nav-link ml-3 py-0" href="#reports">Формирование отчетов</a>
              <a class="nav-link ml-3 py-0" href="#manage-wagons">Работа с вагонами</a>
            </nav>
            <a class="nav-link py-0" href="#requirement">Требования</a>
          </nav>
        </div>
      </div>

      <div class="col-10">
        <section id="annotation">
          <h5 class="mt-2">Аннотация</h5>
          <p class="mb-1">Настоящее руководство содержит сведения о назначении, принципах
            работы веб-приложения "Учет задержанных и длительно простаивающих вагонов".</p>
          <p class="mb-1">Приложение предназначено для осуществения оперативного контроля за
            вагонами, задержанными и длительно простаивающими на станции.</p>
          <p class="mb-1">Вагон считается <strong>задержанным</strong>:<br>
            - по технической или коммерческой неисправности,<br>
            - по требованию государственных контролирующих органов,<br>
            - по отсутствию или ненадлежащему заполнению необходимых перевозочных документов<br>
            с момента составления акта соответствующей формы.</p>
          <p class="mb-1">Вагон <strong>перестает быть задержанным</strong>:<br>
            - с момента выпуска из ремонта (для технической неисправности вагона),<br>
            - с момента утранения (для коммерческой неисправности вагона),<br>
            - с момента выпуска (для вагона, задержанного государственным контролирующим органом).<br>
            - с момента предоставления или надлежащего составления перевозодных документов,
            оформленного соответствующим документом (актом).
          <p class="mr-1">С этого момента вагон находится в распоряжении станции и на него начинает рассчитываться
            простой.</p>
          <p class="mb-1"> Вагон считается <strong>длительно простаивающим</strong>, если прошло более 24 часов:<br>
            - с момента прибытия (для транзитного вагона),<br>
            - с момента окончания грузовой операции (для местного вагона),<br>
            - с момента выпуска из ремонта (для технической неисправности вагона),<br>
            - с момента утранения (для коммерческой неисправности вагона),<br>
            - с момента выпуска (для вагона, задержанного государственным контролирующим органом).<br>
          </p>
          <p class="mr-1">Вагон <strong>перестает быть длительно простаиваюшим</strong> с момента отправления вагона со
            станции</p>
          <p class="mr-1">Вагон находится <strong>на контроле</strong> если задержан, выпущен или длительно простаивает
            на станции. Вагон <strong>снимается с контроля</strong> с момента отправления со станции.</p>
          <p class="mb-1">Ввод в веб-проложение информации по вагонам осуществляется уполномоченными работниками
            станции. По каждому вагону фиксируется инвентарный номер, время задержания, время выпуска (снятия задержки),
            время отправления; кем задержан и по какой причине; принятые меры. Опционально заполняется информация о
            грузе, собственнике, экспедиторе; станции отправления и назначения; времени прибытия; признак возврата (для
            ЛДЗ). Для местных вагонов заполняется информация по грузовой операции, парке и пути, направлению по плану
            формирования.</p>
          <p class="mb-1">На основании введенной информации по вагонам приложение рассчитывает время задержки, время
            простоя по каждому вагону. Приложение позволяет отбирать списки вагонов и просматривать информация по
            каждому из них различными способами. Подробнее в разделе интерфейс.</p>
        </section>

        <section id="interface">
          <h5 class="mt-5">Интерфейс приложения</h5>
          <p class="mb-1">"Учет задержанных и длительно простаивающих вагонов" является традиционным веб-приложением.
            Для работы с ним необходим веб-браузер на компьютере с выходом в Единую сеть передачи данных Белорусской
            железной дороги. Приложение находится по адресу http://dpv.plck.rw/.</p>
          <p class="mb-1">В интерфейсе сайта веб-проложения используются цветовые элементы:<br>
            <span class="badge badge-primary">33</span> (число белого цвета на квадрате синего цвета с закругленными
            углами) &mdash; означает количество задержанных вагонов, являеется ссылкой на соответствующую страницу сайта
            приложения.<br>
            <span class="badge badge-danger">12</span> (число белого цвета на квадрате красного цвета с закругленными
            углами) &mdash; означает количество длительно простаивающих вагонов вагонов, являеется ссылкой на соответствующую страницу сайта
            приложения.<br>
            <span class="badge badge-secondary">40</span> (число белого цвета на квадрате серого цвета с закругленными углами) &mdash; означает количество вагонов на контроле, являеется ссылкой на соответствующую страницу сайта приложения.<br>
            Во всех таблицах в колонке "инвентарный номер" цифры номера являются ссылкой на просмотр полной информации о вагоне и могут принимать цвет в зависимости от статуса вагона:<br>
            <span class="badge badge-success">25</span> (число белого цвета на квадрате зеленого цвета с закругленными углами) &mdash; означает количество вагонов на контроле, являеется ссылкой на соответствующую страницу сайта приложения.<br>
            Во всех таблицах в колонке "инвентарный номер" цифры номера являются ссылкой на просмотр полной информации о вагоне и могут принимать цвет в зависимости от статуса вагона:<br>
            <span class="text-primary">68415546</span> &mdash; задержан,<br>
            <span class="text-danger">92624444</span> &mdash; длительно простаивает,<br>
            <span class="text-secondary">74961624</span> &mdash; на контроле,<br>
            <span class="text-success">67707869</span> &mdash; отправлен.<br>
          </p>
          <p class="mb-1"></p>
          <p class="mb-1"></p>
          <p class="mb-1"></p>
          <p class="mb-1"></p>
          <p class="mb-1"></p>
          <p class="mb-1"></p>
          <p class="mb-1"></p>
          <p class="mb-1"></p>
          <p class="mb-1"></p>
          <p class="mb-1"></p>
        </section>

        <section id="root-page">
          <h5 class="mt-5">Главная страница</h5>
          <p class="mb-1">В разработке</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam asperiores commodi dignissimos distinctio
            eos est expedita explicabo, fugit harum labore maiores necessitatibus odit pariatur, porro possimus
            provident quam quo reprehenderit sint tempora tenetur velit voluptate voluptatibus. Adipisci aliquid aperiam
            aut beatae commodi consequuntur deserunt dolorem dolores ducimus eaque explicabo fuga id ipsum iure
            laboriosam libero molestiae nemo odit omnis pariatur perferendis perspiciatis porro provident, quis
            reiciendis sapiente sed sequi soluta tenetur ullam? Aliquid atque aut consequuntur deleniti dolore dolorum
            ea enim illo, ipsa magnam modi mollitia nesciunt odit placeat veritatis voluptate voluptatem? A consequuntur
            cum doloribus exercitationem pariatur perspiciatis quasi quibusdam quod recusandae repudiandae! Aliquid
            consequatur dolor dolore ea eos iste obcaecati optio qui ratione vero! Accusantium aliquid animi consectetur
            corporis delectus deleniti dolor dolorum, eum eveniet harum in laboriosam laborum laudantium libero magni,
            minus nam natus nesciunt, nulla numquam omnis quia quibusdam repudiandae temporibus tenetur totam
            voluptatum! Consectetur cum doloribus iusto mollitia placeat ratione sunt tenetur voluptatibus. Accusantium
            asperiores autem dicta ducimus earum eum facilis inventore ipsa nobis provident, quisquam ratione repellat
            repudiandae, sequi voluptas! Ea eaque eos eveniet laboriosam mollitia temporibus tenetur ut. Accusamus,
            aperiam dolores iste iusto magnam modi nam nisi odio optio quae reiciendis rem totam vitae. Assumenda cumque
            dolores molestias nihil placeat porro quas, quod sequi? Accusamus accusantium amet, assumenda atque beatae
            consequatur consequuntur culpa delectus dolore doloribus, dolorum eaque esse exercitationem fuga fugiat ipsa
            necessitatibus non nulla placeat porro provident quae quis sint sunt ullam voluptatibus voluptatum? Animi
            atque cumque eaque illum ipsam itaque maxime molestiae, numquam obcaecati officia praesentium quo
            repellendus voluptas? Accusamus accusantium animi aperiam architecto aspernatur assumenda consequatur culpa
            distinctio dolor dolorem, eaque earum excepturi explicabo, facilis fuga illum ipsa iusto labore laboriosam
            magnam molestias mollitia natus nemo nesciunt, numquam odio odit omnis optio perspiciatis quibusdam rem
            repellat sit sunt ullam velit vitae voluptas. Amet atque eligendi placeat. Adipisci animi architecto atque,
            aut commodi, dolorem dolores earum facere hic in ipsum molestias natus, nobis officia quae quo reiciendis
            reprehenderit. Aliquam architecto deserunt dolorem eligendi est fugiat labore laboriosam, nihil nulla,
            perferendis quis, quisquam recusandae saepe temporibus ut veniam voluptatum! Debitis deserunt eligendi
            eveniet, explicabo ipsum iure laudantium magnam molestiae mollitia pariatur ut veritatis vitae voluptatum!
            Accusamus aliquam beatae ducimus eaque eius est fugiat hic in ipsam iusto minus necessitatibus, nulla
            perferendis praesentium repellat saepe suscipit, veritatis voluptates. Alias ducimus earum eius, eum,
            expedita explicabo illo in labore laboriosam minima minus modi nisi ratione rem sed similique vel.
            Accusantium amet autem beatae blanditiis consequuntur cum cumque delectus deserunt distinctio dolor dolores
            dolorum ducimus eius eligendi error esse fugit ipsam magni natus nesciunt officia omnis placeat quis
            quisquam quod reiciendis, repellat repudiandae sapiente sed sit sunt suscipit ullam unde vel veniam
            voluptates voluptatibus. A accusantium cupiditate deleniti deserunt dignissimos eum facilis, impedit
            necessitatibus, nemo nihil odio provident quaerat, repellat repudiandae sint ullam voluptatem voluptatibus!
            Aspernatur, cum, debitis ducimus expedita facere itaque maxime molestiae necessitatibus omnis provident qui
            rerum ut! Aliquam animi assumenda blanditiis, debitis deserunt dignissimos ducimus esse eum eveniet fugiat
            id illo ipsa, laboriosam laborum magnam magni minima modi molestiae natus nemo provident quis quo rem
            repudiandae, tempora temporibus ut vero. A accusamus, cupiditate deserunt dolor earum est expedita fugiat
            fugit illum ipsum mollitia odit officia quae quasi quidem quod temporibus! Aliquam aperiam architecto dolore
            est molestiae molestias quo sint ullam veritatis. Accusantium adipisci dicta eligendi eum ipsum neque
            praesentium quod voluptatibus. A assumenda, cupiditate deserunt dolorum eius et excepturi facere magnam modi
            </p>
        </section>

        <section id="reports">
          <h5 class="mt-5">Формирование отчетов</h5>
          <p class="mb-1">В разработке</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam asperiores commodi dignissimos distinctio
            eos est expedita explicabo, fugit harum labore maiores necessitatibus odit pariatur, porro possimus
            provident quam quo reprehenderit sint tempora tenetur velit voluptate voluptatibus. Adipisci aliquid aperiam
            aut beatae commodi consequuntur deserunt dolorem dolores ducimus eaque explicabo fuga id ipsum iure
            laboriosam libero molestiae nemo odit omnis pariatur perferendis perspiciatis porro provident, quis
            reiciendis sapiente sed sequi soluta tenetur ullam? Aliquid atque aut consequuntur deleniti dolore dolorum
            ea enim illo, ipsa magnam modi mollitia nesciunt odit placeat veritatis voluptate voluptatem? A consequuntur
            cum doloribus exercitationem pariatur perspiciatis quasi quibusdam quod recusandae repudiandae! Aliquid
            consequatur dolor dolore ea eos iste obcaecati optio qui ratione vero! Accusantium aliquid animi consectetur
            corporis delectus deleniti dolor dolorum, eum eveniet harum in laboriosam laborum laudantium libero magni,
            minus nam natus nesciunt, nulla numquam omnis quia quibusdam repudiandae temporibus tenetur totam
            voluptatum! Consectetur cum doloribus iusto mollitia placeat ratione sunt tenetur voluptatibus. Accusantium
            asperiores autem dicta ducimus earum eum facilis inventore ipsa nobis provident, quisquam ratione repellat
            repudiandae, sequi voluptas! Ea eaque eos eveniet laboriosam mollitia temporibus tenetur ut. Accusamus,
            aperiam dolores iste iusto magnam modi nam nisi odio optio quae reiciendis rem totam vitae. Assumenda cumque
            dolores molestias nihil placeat porro quas, quod sequi? Accusamus accusantium amet, assumenda atque beatae
            consequatur consequuntur culpa delectus dolore doloribus, dolorum eaque esse exercitationem fuga fugiat ipsa
            necessitatibus non nulla placeat porro provident quae quis sint sunt ullam voluptatibus voluptatum? Animi
            atque cumque eaque illum ipsam itaque maxime molestiae, numquam obcaecati officia praesentium quo
            repellendus voluptas? Accusamus accusantium animi aperiam architecto aspernatur assumenda consequatur culpa
            distinctio dolor dolorem, eaque earum excepturi explicabo, facilis fuga illum ipsa iusto labore laboriosam
            magnam molestias mollitia natus nemo nesciunt, numquam odio odit omnis optio perspiciatis quibusdam rem
            repellat sit sunt ullam velit vitae voluptas. Amet atque eligendi placeat. Adipisci animi architecto atque,
            aut commodi, dolorem dolores earum facere hic in ipsum molestias natus, nobis officia quae quo reiciendis
            reprehenderit. Aliquam architecto deserunt dolorem eligendi est fugiat labore laboriosam, nihil nulla,
            perferendis quis, quisquam recusandae saepe temporibus ut veniam voluptatum! Debitis deserunt eligendi
            eveniet, explicabo ipsum iure laudantium magnam molestiae mollitia pariatur ut veritatis vitae voluptatum!
            Accusamus aliquam beatae ducimus eaque eius est fugiat hic in ipsam iusto minus necessitatibus, nulla
            perferendis praesentium repellat saepe suscipit, veritatis voluptates. Alias ducimus earum eius, eum,
            expedita explicabo illo in labore laboriosam minima minus modi nisi ratione rem sed similique vel.
            Accusantium amet autem beatae blanditiis consequuntur cum cumque delectus deserunt distinctio dolor dolores
            dolorum ducimus eius eligendi error esse fugit ipsam magni natus nesciunt officia omnis placeat quis
            quisquam quod reiciendis, repellat repudiandae sapiente sed sit sunt suscipit ullam unde vel veniam
            voluptates voluptatibus. A accusantium cupiditate deleniti deserunt dignissimos eum facilis, impedit
            necessitatibus, nemo nihil odio provident quaerat, repellat repudiandae sint ullam voluptatem voluptatibus!
            Aspernatur, cum, debitis ducimus expedita facere itaque maxime molestiae necessitatibus omnis provident qui
            rerum ut! Aliquam animi assumenda blanditiis, debitis deserunt dignissimos ducimus esse eum eveniet fugiat
            id illo ipsa, laboriosam laborum magnam magni minima modi molestiae natus nemo provident quis quo rem
            repudiandae, tempora temporibus ut vero. A accusamus, cupiditate deserunt dolor earum est expedita fugiat
            fugit illum ipsum mollitia odit officia quae quasi quidem quod temporibus! Aliquam aperiam architecto dolore
            est molestiae molestias quo sint ullam veritatis. Accusantium adipisci dicta eligendi eum ipsum neque
            praesentium quod voluptatibus. A assumenda, cupiditate deserunt dolorum eius et excepturi facere magnam modi
          </p>
        </section>

        <section id="manage-wagons">
          <h5 class="mt-5">Работа с вагонами</h5>
          <p class="mb-1">В разработке</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam asperiores commodi dignissimos distinctio
            eos est expedita explicabo, fugit harum labore maiores necessitatibus odit pariatur, porro possimus
            provident quam quo reprehenderit sint tempora tenetur velit voluptate voluptatibus. Adipisci aliquid aperiam
            aut beatae commodi consequuntur deserunt dolorem dolores ducimus eaque explicabo fuga id ipsum iure
            laboriosam libero molestiae nemo odit omnis pariatur perferendis perspiciatis porro provident, quis
            reiciendis sapiente sed sequi soluta tenetur ullam? Aliquid atque aut consequuntur deleniti dolore dolorum
            ea enim illo, ipsa magnam modi mollitia nesciunt odit placeat veritatis voluptate voluptatem? A consequuntur
            cum doloribus exercitationem pariatur perspiciatis quasi quibusdam quod recusandae repudiandae! Aliquid
            consequatur dolor dolore ea eos iste obcaecati optio qui ratione vero! Accusantium aliquid animi consectetur
            corporis delectus deleniti dolor dolorum, eum eveniet harum in laboriosam laborum laudantium libero magni,
            minus nam natus nesciunt, nulla numquam omnis quia quibusdam repudiandae temporibus tenetur totam
            voluptatum! Consectetur cum doloribus iusto mollitia placeat ratione sunt tenetur voluptatibus. Accusantium
            asperiores autem dicta ducimus earum eum facilis inventore ipsa nobis provident, quisquam ratione repellat
            repudiandae, sequi voluptas! Ea eaque eos eveniet laboriosam mollitia temporibus tenetur ut. Accusamus,
            aperiam dolores iste iusto magnam modi nam nisi odio optio quae reiciendis rem totam vitae. Assumenda cumque
            dolores molestias nihil placeat porro quas, quod sequi? Accusamus accusantium amet, assumenda atque beatae
            consequatur consequuntur culpa delectus dolore doloribus, dolorum eaque esse exercitationem fuga fugiat ipsa
            necessitatibus non nulla placeat porro provident quae quis sint sunt ullam voluptatibus voluptatum? Animi
            atque cumque eaque illum ipsam itaque maxime molestiae, numquam obcaecati officia praesentium quo
            repellendus voluptas? Accusamus accusantium animi aperiam architecto aspernatur assumenda consequatur culpa
            distinctio dolor dolorem, eaque earum excepturi explicabo, facilis fuga illum ipsa iusto labore laboriosam
            magnam molestias mollitia natus nemo nesciunt, numquam odio odit omnis optio perspiciatis quibusdam rem
            repellat sit sunt ullam velit vitae voluptas. Amet atque eligendi placeat. Adipisci animi architecto atque,
            aut commodi, dolorem dolores earum facere hic in ipsum molestias natus, nobis officia quae quo reiciendis
            reprehenderit. Aliquam architecto deserunt dolorem eligendi est fugiat labore laboriosam, nihil nulla,
            perferendis quis, quisquam recusandae saepe temporibus ut veniam voluptatum! Debitis deserunt eligendi
            eveniet, explicabo ipsum iure laudantium magnam molestiae mollitia pariatur ut veritatis vitae voluptatum!
            Accusamus aliquam beatae ducimus eaque eius est fugiat hic in ipsam iusto minus necessitatibus, nulla
            perferendis praesentium repellat saepe suscipit, veritatis voluptates. Alias ducimus earum eius, eum,
            expedita explicabo illo in labore laboriosam minima minus modi nisi ratione rem sed similique vel.
            Accusantium amet autem beatae blanditiis consequuntur cum cumque delectus deserunt distinctio dolor dolores
            dolorum ducimus eius eligendi error esse fugit ipsam magni natus nesciunt officia omnis placeat quis
            quisquam quod reiciendis, repellat repudiandae sapiente sed sit sunt suscipit ullam unde vel veniam
            voluptates voluptatibus. A accusantium cupiditate deleniti deserunt dignissimos eum facilis, impedit
            necessitatibus, nemo nihil odio provident quaerat, repellat repudiandae sint ullam voluptatem voluptatibus!
            Aspernatur, cum, debitis ducimus expedita facere itaque maxime molestiae necessitatibus omnis provident qui
            rerum ut! Aliquam animi assumenda blanditiis, debitis deserunt dignissimos ducimus esse eum eveniet fugiat
            id illo ipsa, laboriosam laborum magnam magni minima modi molestiae natus nemo provident quis quo rem
            repudiandae, tempora temporibus ut vero. A accusamus, cupiditate deserunt dolor earum est expedita fugiat
            fugit illum ipsum mollitia odit officia quae quasi quidem quod temporibus! Aliquam aperiam architecto dolore
            est molestiae molestias quo sint ullam veritatis. Accusantium adipisci dicta eligendi eum ipsum neque
            praesentium quod voluptatibus. A assumenda, cupiditate deserunt dolorum eius et excepturi facere magnam modi
          </p>
        </section>

        <section id="requirement">
          <h5 class="mt-5">Требования</h5>
          <p class="mb-1">В разработке</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam asperiores commodi dignissimos distinctio
            eos est expedita explicabo, fugit harum labore maiores necessitatibus odit pariatur, porro possimus
            provident quam quo reprehenderit sint tempora tenetur velit voluptate voluptatibus. Adipisci aliquid aperiam
            aut beatae commodi consequuntur deserunt dolorem dolores ducimus eaque explicabo fuga id ipsum iure
            laboriosam libero molestiae nemo odit omnis pariatur perferendis perspiciatis porro provident, quis
            reiciendis sapiente sed sequi soluta tenetur ullam? Aliquid atque aut consequuntur deleniti dolore dolorum
            ea enim illo, ipsa magnam modi mollitia nesciunt odit placeat veritatis voluptate voluptatem? A consequuntur
            cum doloribus exercitationem pariatur perspiciatis quasi quibusdam quod recusandae repudiandae! Aliquid
            consequatur dolor dolore ea eos iste obcaecati optio qui ratione vero! Accusantium aliquid animi consectetur
            corporis delectus deleniti dolor dolorum, eum eveniet harum in laboriosam laborum laudantium libero magni,
            minus nam natus nesciunt, nulla numquam omnis quia quibusdam repudiandae temporibus tenetur totam
            voluptatum! Consectetur cum doloribus iusto mollitia placeat ratione sunt tenetur voluptatibus. Accusantium
            asperiores autem dicta ducimus earum eum facilis inventore ipsa nobis provident, quisquam ratione repellat
            repudiandae, sequi voluptas! Ea eaque eos eveniet laboriosam mollitia temporibus tenetur ut. Accusamus,
            aperiam dolores iste iusto magnam modi nam nisi odio optio quae reiciendis rem totam vitae. Assumenda cumque
            dolores molestias nihil placeat porro quas, quod sequi? Accusamus accusantium amet, assumenda atque beatae
            consequatur consequuntur culpa delectus dolore doloribus, dolorum eaque esse exercitationem fuga fugiat ipsa
            necessitatibus non nulla placeat porro provident quae quis sint sunt ullam voluptatibus voluptatum? Animi
            atque cumque eaque illum ipsam itaque maxime molestiae, numquam obcaecati officia praesentium quo
            repellendus voluptas? Accusamus accusantium animi aperiam architecto aspernatur assumenda consequatur culpa
            distinctio dolor dolorem, eaque earum excepturi explicabo, facilis fuga illum ipsa iusto labore laboriosam
            magnam molestias mollitia natus nemo nesciunt, numquam odio odit omnis optio perspiciatis quibusdam rem
            repellat sit sunt ullam velit vitae voluptas. Amet atque eligendi placeat. Adipisci animi architecto atque,
            aut commodi, dolorem dolores earum facere hic in ipsum molestias natus, nobis officia quae quo reiciendis
            reprehenderit. Aliquam architecto deserunt dolorem eligendi est fugiat labore laboriosam, nihil nulla,
            perferendis quis, quisquam recusandae saepe temporibus ut veniam voluptatum! Debitis deserunt eligendi
            eveniet, explicabo ipsum iure laudantium magnam molestiae mollitia pariatur ut veritatis vitae voluptatum!
            Accusamus aliquam beatae ducimus eaque eius est fugiat hic in ipsam iusto minus necessitatibus, nulla
            perferendis praesentium repellat saepe suscipit, veritatis voluptates. Alias ducimus earum eius, eum,
            expedita explicabo illo in labore laboriosam minima minus modi nisi ratione rem sed similique vel.
            Accusantium amet autem beatae blanditiis consequuntur cum cumque delectus deserunt distinctio dolor dolores
            dolorum ducimus eius eligendi error esse fugit ipsam magni natus nesciunt officia omnis placeat quis
            quisquam quod reiciendis, repellat repudiandae sapiente sed sit sunt suscipit ullam unde vel veniam
            voluptates voluptatibus. A accusantium cupiditate deleniti deserunt dignissimos eum facilis, impedit
            necessitatibus, nemo nihil odio provident quaerat, repellat repudiandae sint ullam voluptatem voluptatibus!
            Aspernatur, cum, debitis ducimus expedita facere itaque maxime molestiae necessitatibus omnis provident qui
            rerum ut! Aliquam animi assumenda blanditiis, debitis deserunt dignissimos ducimus esse eum eveniet fugiat
            id illo ipsa, laboriosam laborum magnam magni minima modi molestiae natus nemo provident quis quo rem
            repudiandae, tempora temporibus ut vero. A accusamus, cupiditate deserunt dolor earum est expedita fugiat
            fugit illum ipsum mollitia odit officia quae quasi quidem quod temporibus! Aliquam aperiam architecto dolore
            est molestiae molestias quo sint ullam veritatis. Accusantium adipisci dicta eligendi eum ipsum neque
            praesentium quod voluptatibus. A assumenda, cupiditate deserunt dolorum eius et excepturi facere magnam modi
            nesciunt, obcaecati odio, pariatur reiciendis sit tempore ullam vitae? Aperiam at beatae consectetur dolor
            dolores doloribus dolorum enim est illo minima nemo perferendis quam qui ratione repellat repudiandae, unde
            vitae voluptas. Autem deserunt distinctio dolore earum, fuga ipsum iusto laudantium minus molestiae nihil
            nisi non odio odit pariatur porro quasi quisquam ratione recusandae repellendus sed similique tempore
            voluptates? Consequatur cumque libero, natus non quam quia quis tempore veniam voluptas voluptates. Aliquid
            autem earum incidunt omnis quae? Consequatur est labore necessitatibus unde vero! Alias animi aspernatur
            consectetur culpa cumque doloribus error ex fugiat impedit incidunt itaque labore magni numquam perspiciatis
            </p>
        </section>


      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
      $('body').scrollspy({target: '#content-nav'});

      $('#content-nav a').on('click', function (e) {
          if (this.hash !== '') {
              e.preventDefault();
              const hash = this.hash;
              $("html, body").animate({
                  scrollTop: $(hash).offset().top
              }, 900, function () {
                  window.location.hash = hash;
              });
          }
      });
  </script>

@endsection


