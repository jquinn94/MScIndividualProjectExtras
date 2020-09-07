#!/../usr/local/bin/python3.7
print ("Content-Type: text/plain;charset=utf-8\n")

from imageai.Prediction.Custom import CustomImagePrediction

prediction = CustomImagePrediction()
prediction.setModelTypeAsResNet()
prediction.setModelPath("model_ex-083_acc-0.838000.h5")
prediction.setJsonPath("model_class_5bananas.json")
prediction.loadModel(num_objects=5)

predictions, probabilities = prediction.predictImage("banana1.jpg", result_count=1)

for eachPrediction, eachProbability in zip(predictions, probabilities):
    if eachProbability > 0:
        print(eachPrediction , " : " , eachProbability)
