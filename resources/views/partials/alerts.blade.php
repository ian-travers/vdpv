<script>
  @if(Session::has('flash'))
    @php $flash = Session::get('flash'); @endphp

    @switch($flash['type'])
      @case('success')
        iziToast.success({
          title: "Успех",
          titleSize: '1.5rem',
          titleLineHeight: '2rem',
          message: "{!! $flash['text'] !!}",
          messageSize: '1.5rem',
          messageLineHeight: '2rem',
          timeout: 4000,
          position: 'topCenter',
          transitionIn: 'flipInX',
          transitionOut: 'flipOutX',
        });
        @break

      @case('warning')
        iziToast.warning({
          title: "Предупреждение",
          titleSize: '1.5rem',
          titleLineHeight: '2rem',
          message: "{!! $flash['text'] !!}",
          messageSize: '1.5rem',
          messageLineHeight: '2rem',
          timeout: 6000,
          position: 'topCenter',
          transitionIn: 'flipInX',
          transitionOut: 'flipOutX',
        });
        @break

      @case('error')
        iziToast.error({
          title: "Ошибка",
          titleSize: '1.5rem',
          titleLineHeight: '2rem',
          message: "{!! $flash['text'] !!}",
          messageSize: '1.5rem',
          messageLineHeight: '2rem',
          timeout: 8000,
          position: 'topCenter',
          transitionIn: 'flipInX',
          transitionOut: 'flipOutX',
        });
        @break

      @default
        iziToast.info({
          title: "Информация",
          titleSize: '1.5rem',
          titleLineHeight: '2rem',
          message: "{!! $flash['text'] !!}",
          messageSize: '1.5rem',
          messageLineHeight: '2rem',
          timeout: 1500,
          position: 'topCenter',
          transitionIn: 'flipInX',
          transitionOut: 'flipOutX',
        });
    @endswitch
  @endif
</script>



