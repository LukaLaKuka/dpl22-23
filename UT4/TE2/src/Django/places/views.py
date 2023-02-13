from django.http import HttpResponse
from django.template import loader

from .models import Place

def index(request):
    template = loader.get_template('places/index.html')
    context = {

    }

    return HttpResponse(template.render(context, request))

def visited(request):
    visited = Place.objects.filter(visited=True)
    template = loader.get_template('places/visited.html')
    context = {
        'visited': visited,
    }
    return HttpResponse(template.render(context, request))

def wished(request):
    wished = Place.objects.filter(visited=False)
    template = loader.get_template('places/wished.html')
    context = {
        'wished': wished,
    }
    return HttpResponse(template.render(context, request))